<?php

namespace App\Http\Controllers\Admin\Project;

use App\Constants\EmployeeTypes;
use App\Constants\TaskStatus;
use App\Constants\TaskType;
use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\IServiceRepository;
use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\SaveProjectRequest;
use App\Http\Requests\Admin\Project\SaveProjectServiceRequest;
use App\Http\Requests\Admin\Project\TeamMemberAccessRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ProjectController extends Controller
{

    /**
     * @var IClientRepository
     */
    private $clientRepository;
    /**
     * @var IEmployeeRepository
     */
    private $employeeRepository;
    /**
     * @var IProjectRepository
     */
    private $projectRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var IProjectServiceRepository
     */
    private $projectServiceRepository;
    /**
     * @var IProjectTeamRepository
     */
    private $teamRepository;
    /**
     * @var IProjectDocumentRepository
     */
    private $documentRepository;
    /**
     * @var IProjectActivityRepository
     */
    private $activityRepository;

    /**
     * @var ITaskRepository
     */
    private $taskRepository;
    private $departmentRepository;
    private $serviceRepository;
    private $userRepository;


    /**
     * @param IProjectRepository $projectRepository
     * @param IProjectServiceRepository $projectServiceRepository
     * @param IProjectTeamRepository $teamRepository
     * @param IProjectDocumentRepository $documentRepository
     * @param IClientRepository $clientRepository
     * @param IEmployeeRepository $employeeRepository
     * @param IFileOperationService $fileOperationService
     * @param IFileOperationService $fileOperationService
     */
    public function __construct(
        IProjectRepository $projectRepository,
        IProjectServiceRepository $projectServiceRepository, IProjectTeamRepository $teamRepository,
        IProjectDocumentRepository $documentRepository,
        IClientRepository $clientRepository,
        IEmployeeRepository $employeeRepository,
        IFileOperationService $fileOperationService,
        ITaskRepository $taskRepository,
        IDepartmentRepository $departmentRepository,
        IProjectActivityRepository $activityRepository,
        IServiceRepository $serviceRepository,
        IUserRepository $userRepository
    )
    {
        $this->clientRepository = $clientRepository;
        $this->employeeRepository = $employeeRepository;
        $this->fileOperationService = $fileOperationService;
        $this->projectServiceRepository = $projectServiceRepository;
        $this->projectRepository = $projectRepository;
        $this->teamRepository = $teamRepository;
        $this->documentRepository = $documentRepository;
        $this->activityRepository = $activityRepository;
        $this->taskRepository = $taskRepository;
        $this->departmentRepository = $departmentRepository;
        $this->serviceRepository = $serviceRepository;
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;
            $user_id = Auth::id();
            $user = $this->userRepository->getCurrentUser();
            if($user->role == 'admin'){
                $rows = $this->projectRepository->gets($recordPerPage);
            }else{
                $rows = $this->projectRepository->gets($recordPerPage, $user_id);
            }

            foreach ($rows as $row)
            {
                $row->teams = $this->teamRepository->gets($row->id);
                $row->documents = $this->documentRepository->gets($row->id);
            }

            return view('admin.pages.project.index', [
                'rows' => $rows,
                'clients' => $this->clientRepository->getAll(),
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
       try{
           $managers = $this->employeeRepository->getForDDL(EmployeeTypes::MANAGER);
           $executives = $this->employeeRepository->getForDDL(EmployeeTypes::EXECUTIVE);
           $clients = $this->clientRepository->getAll();
           return view('admin.pages.project.create', [
               'clients' => $clients,
               'managers' => $managers,
               'executives' => $executives
           ]);
       }catch (Exception $ex){
           return view('admin.shared.error', [
               'error_msg' => $ex->getMessage()
           ]);
       }
    }

    /**
     * @param SaveProjectRequest $request
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse|void
     */
    public function store(SaveProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if($model['deadline'] < $model['target'])
                return redirect()->back()->with(['error_msg' => 'Target date is not valid!'])->withInput();

            $folder = "uploads/project/thumbnails";
            if(array_key_exists('thumbnail', $model)){
                $fileInfo = $this->fileOperationService->upload($model['thumbnail'], $folder);
                $model['thumbnail'] = $fileInfo['path'];
            }else{
                $model['thumbnail'] = $folder."/default.png";
            }
            $id = $this->projectRepository->store($model);
            DB::commit();
            return redirect()->route('admin/project/service/next', ['id' => $id])->with(['success_msg' => 'Project basic info saved']);

        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit(int $id)
    {
        try {
            $project = $this->projectRepository->getById($id);
            if(empty($project))
                return redirect()->back()->with('error_msg', "Invalid url");

            $project->teams_id = $this->teamRepository->gets($id)->pluck('employee_id')->toArray();
            $managers = $this->employeeRepository->getForDDL(EmployeeTypes::MANAGER);
            $executives = $this->employeeRepository->getForDDL(EmployeeTypes::EXECUTIVE);
            $clients = $this->clientRepository->getAll();
            return view('admin.pages.project.edit', [
                'clients' => $clients,
                'managers' => $managers,
                'executives' => $executives,
                'project' => $project
            ]);
        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update(SaveProjectRequest $request, $id)
    {
        try {
            $model = $request->validated();

            if($model['deadline'] < $model['target'])
                return redirect()->back()->with(['error_msg' => 'Target date is not valid!'])->withInput();

            $project = $this->projectRepository->getById($id);

            $folder = "uploads/project/thumbnails";
            if(array_key_exists('thumbnail', $model)){
                if($project->thumbnail == "$folder/default.png")
                    $this->fileOperationService->delete($project->thumbnail);

                $fileInfo = $this->fileOperationService->upload($model['thumbnail'], $folder);
                $model['thumbnail'] = $fileInfo['path'];
            }else{
                $model['thumbnail'] = $project->thumbnail;
            }

            $this->projectRepository->update($model, $id);
            return redirect()->route('admin/project/service/next', ['id' => $id])->with(['success_msg' => 'Project basic info updated']);

        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function next(int $id): View
    {
        try {
            return view('admin.pages.project.next', [
                'id' => $id,
                'services' => $this->projectServiceRepository->getServices($id)
            ]);
        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function nextUpdate(Request $request, int $id){
        try {
            DB::beginTransaction();
            $request->validate([
                'purchase_id' => 'required',
                'department_id' => 'required',
                'service_id' => 'required',
                'purchase_type' => 'required',
                'total_hour' => 'required',
                'hour' => '',
                'number_of_employee' => '',
                'working_day' => '',
            ]);
            $purchase_service_id = $request->purchase_id;
            $model = [
                'dept_id' => $request->department_id,
                'service_id' => $request->service_id,
                'purchase_type' => $request->purchase_type,
                'total_hour' => $request->total_hour,
            ];
            $model2 = [
                'hour' => $request->hour,
                'number_of_employee' => $request->number_of_employee,
                'working_day' => $request->working_day,
            ];
            $this->projectServiceRepository->update($model, $purchase_service_id, $model2);
            DB::commit();
            return redirect()->route('admin/project/service/next', ['id'=>$id])->with('success_msg', 'Service Updated !');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin/project/service/next', ['id'=>$id])->with('error_msg', $e->getMessage());
        }
    }
    public function nextEdit(int $id, int $serviceId)
    {
        try {
            $purchaseService = $this->projectServiceRepository->getServiceByPurchaseId($serviceId);
            $services = $this->serviceRepository->getAll($purchaseService->dept_id);
            $departments = $this->departmentRepository->getAll();

            if ($purchaseService->purchase_type === 2) {
                $purchaseService = $this->projectServiceRepository->getServiceByPurchaseId($serviceId, 2);
                return response()->json([
                    'status' => 200,
                    'message' => 'Something went wrong!',
                    'data' => view('admin.pages.project.project-purchase-service-edit-2', [
                        'project_id'        => $id,
                        'departments'       => $departments,
                        'purchaseService'   => $purchaseService,
                        'services'          => $services
                    ])->render()
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Something went wrong!',
                'data' => view('admin.pages.project.project-purchase-service-edit', [
                    'project_id'        => $id,
                    'departments'       => $departments,
                    'purchaseService'   => $purchaseService,
                    'services'          =>$services
                ])->render()
            ]);
        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function storeService($id, SaveProjectServiceRequest $request)
    {
        try {
            $this->projectServiceRepository->store($request->validated(), $id);
            if($request->input('f') == 'o')
                return redirect()->route('admin/project/service/gridView', ['id' => $id])->with(['success_msg' => 'Service has been added']);

            return redirect()->route('admin/project/service/next', ['id' => $id])->with(['success_msg' => 'Service has been added']);

        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function deleteService($id, $service_id)
    {
        try {
            $this->projectServiceRepository->delete($service_id, $id);
            return redirect()->route('admin/project/service/next', ['id' => $id])->with(['success_msg' => 'Service has been removed']);

        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function cancel($id)
    {
        try {
            $this->projectRepository->cancel($id);
            $content = Generator::activityContent([
                'h6' => 'Project Cancel'
            ]);
            $this->activityRepository->insert($id, $content);
            return redirect()->route('admin/project/index')->with(['success_msg' => 'Project has been removed']);
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function remove($id)
    {
        DB::beginTransaction();
        try {
            $project = $this->projectRepository->getById($id);
            if(empty($project))
                return view('admin.shared.404');

            $this->projectRepository->delete($id);
            return redirect()->route('admin/project/index')->with(['success_msg' => 'Project has been deleted']);

        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
    public function overview($id): View
    {
        try {
            $project = $this->projectRepository->getById($id);
            if(empty($project))
                return view('admin.shared.404');
            $project->document_count = $this->documentRepository->count($id);
            $project->team_member_count = $this->teamRepository->count($id);
            $project->activities = $this->activityRepository->gets(10, $id);
            $project->in_reviewTasks = $this->taskRepository->gets($id, 0,0,TaskStatus::IN_PROGRESS);

            return view('admin.pages.project.overview', [
                'project' => $project
            ]);
        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }


    public function serviceGridView($id): View
    {
        try {
            $services = $this->projectServiceRepository->getServices($id);
            return view('admin.pages.project.service.grid', compact('services'));
        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function serviceTableView($id): View
    {
        try {
            $services = $this->projectServiceRepository->getServices($id);
            return view('admin.pages.project.service.table', compact('services'));
        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function addTeam(): View
    {
        return view('admin.pages.project.team.add');
    }

    /**
     * @param int $id
     * @param int $department_id
     * @return JsonResponse
     */
    public function getServicesByDepartment(int $id, int $department_id): JsonResponse
    {
        try {
            return response()->json([
                'status' => 200,
                'data' => $this->projectServiceRepository->getServicesByDepartment($id, $department_id)
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    public function getStatus(){

    }

    public function updateStatus($id)
    {
        $projectService = $this->projectServiceRepository->getServices($id);

        try {
            DB::beginTransaction();
            $status = request()->input('status');
            $activityMessage = '';

            if($status == 1){
                $this->projectRepository->updateStatus($status, $id);
                $activityMessage = 'Project status changed to NEW';
            }
            if($status == 2){
                $this->projectRepository->updateStatus($status, $id);
                $activityMessage = 'Project status changed to IN-PROGRESS';
            }
            if($status == 3){
                if(!$this->projectRepository->isAllTaskComplete($id)){
                    $this->projectRepository->updateStatus($status, $id);
                    $activityMessage = 'Project status changed to COMPLETED';
                }else{
                    return response()->json([
                        'status' => 200,
                        'data' => 'Complete all tasks.'
                    ]);
                }
            }
            $content = Generator::activityContent([
                'h6' => $activityMessage
            ]);
            $this->activityRepository->insert($id, $content);
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => 'success'
            ]);

        }catch (Exception $ex){
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function ProjectByMember()
    {
        $member = request()->input('member_id');
        $recordPerPage = 15;
        $projects = $member ? $this->projectRepository->getProjectsByUserId( $member, $recordPerPage) : $this->projectRepository->gets($recordPerPage);
        $employees = $this->employeeRepository->gets();
        $employee_details = $this->userRepository->getById($member);
        foreach ($projects as $project){
            $project->task = $this->taskRepository->gets($project->id, TaskType::MAIN);
        }
        return view('admin/pages/project/project-by-member', compact('projects', 'employees', 'employee_details'))->with('i', Helpers::SerialCalculateForPage($recordPerPage));
    }
}

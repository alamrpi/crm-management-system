<?php

namespace App\Http\Controllers\Admin;
use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IServiceRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\SaveServiceRequest;
use App\Utility\Helpers;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * @var IServiceRepository
     */
    private $serviceRepository;
    /**
     * @var IDepartmentRepository
     */
    private $departmentRepository;
    private $projectServiceRepository;

    public function __construct(IServiceRepository $serviceRepository, IDepartmentRepository $departmentRepository, IProjectServiceRepository $projectServiceRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->departmentRepository = $departmentRepository;
        $this->projectServiceRepository = $projectServiceRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('admin.pages.department.service.index', [
                'rows' => $this->serviceRepository->gets($recordPerPage),
                'departments' => $this->departmentRepository->getAll()
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        $departments = $this->departmentRepository->getAll();
        return view('admin.pages.department.service.create', [
            'departments' => $departments
        ]);
    }

    public function store(SaveserviceRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->serviceRepository->findByName($model['service_name'])))
                return redirect()->back()->with('error_msg', "Duplicate service name not allowed!")->withInput();

            $this->serviceRepository->insert($model);
            DB::commit();
            return redirect()->route('admin/department/service/index')->with('success_msg', "Service has been created successfully");
        }
        catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit(int $id){
        try {
            $service = $this->serviceRepository->findById($id);
            $departments = $this->departmentRepository->getAll();
            return view('admin.pages.department.service.edit', [
                'departments' => $departments,
                'service' => $service
            ]);
        }
        catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update(SaveserviceRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->serviceRepository->findByName($model['service_name'], $id)))
                return redirect()->back()->with('error_msg', "Duplicate service name not allowed!")->withInput();

            $this->serviceRepository->update($id, $model);
            DB::commit();
            return redirect()->route('admin/department/service/index')->with('success_msg', "Service has been updated successfully");
        }
        catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {

            if(empty($this->serviceRepository->findById($id)))
                return redirect()->back()->with('error_msg', "Request is not valid!")->withInput();

            if($this->projectServiceRepository->existsByService($id))
                return redirect()->back()->with('error_msg', "This service used in project. so you can't delete.")->withInput();

            $this->serviceRepository->delete($id);
            DB::commit();
            return redirect()->route('admin/department/service/index')->with('success_msg', "Service has been deleted successfully");
        }
        catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    //Actions for the ajax request

    public function getForDdl(): JsonResponse
    {
        try {
            $department_id = request()->input('department_id');
            $departments = $this->serviceRepository->getAll($department_id);
            $dd_options = '';
            if(count($departments) > 0)
            {
                $dd_options .= "<option value=\"\">--Select--</option>";
                foreach ($departments as $service)
                    $dd_options .= "<option value=\"$service->id\">$service->service_name</option>";
            }else{
                $dd_options .= "<option value=\"\">Not Available</option>";
            }

            return response()->json([
                'status' => 200,
                'message' => '',
                'data' => $dd_options
            ]);
        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'Message' => "Internal Server Error"
            ]);
        }
    }
}

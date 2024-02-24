<?php

namespace App\Http\Controllers\Admin\Project;

use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\TeamMemberRequest;
use App\Utility\ActivityGenerator;
use App\Utility\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TeamController extends Controller
{
    private $teamRepository;
    private $projectRepository;
    private $employeeRepository;
    private $activityRepository;

    /**
     * @param IProjectRepository $projectRepository
     * @param IProjectTeamRepository $teamRepository
     * @param IEmployeeRepository $employeeRepository
     */
    public function __construct(
        IProjectRepository     $projectRepository,
        IProjectTeamRepository $teamRepository,
        IEmployeeRepository    $employeeRepository,
        IProjectActivityRepository $activityRepository
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->projectRepository = $projectRepository;
        $this->teamRepository = $teamRepository;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @param $id
     * @return View
     */
    public function team($id): View
    {
        try {
            $name = request()->input('name');
            $recordPerPage = 15;
            $teams = $this->teamRepository->getsWithPagination($id, $recordPerPage, $name);
            $roles = $this->employeeRepository->getAllEmployeeType();
            return view('admin.pages.project.team.index',[
                'teams' => $teams,
                'project_id' => $id,
                'roles'     => $roles
            ]);

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }

    }
    /**
     * @param $id
     * @return View
     */
    public function teamMemberProfile($memberId): View
    {
        try {
            $user = Auth::user();
            $name = request()->input('name');
            $teams = $this->teamRepository->gets($id, $name);
            if ($user->role === 'admin') {
                return view('admin.pages.project.team.admin-profile', [
                    'teams' => $teams,
                    'project_id' => $id
                ]);
            }else{
                return view('admin.pages.project.team.employee-profile', [
                    'teams' => $teams,
                    'project_id' => $id
                ]);
            }

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }

    }

    /**
     * @return JsonResponse
     */
    public function getMemberByDepartmentId() : JsonResponse
    {
        try{
            $project_id = Helpers::getParamValue('id');
            $department_id = request()->input('department_id');
            $members = $this->employeeRepository->getForDDL(null, $project_id, $department_id);
            return response()->json([
                'status' => 200,
                'message' => '',
                'data' => $members
            ]);
        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'Message' => $ex->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @param TeamMemberRequest $request
     * @return JsonResponse
     */
    public function assignMember($id, TeamMemberRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $project_id = $id;
            $data = $request->data;
            $data = [
                'manager_ids' => $data['manager_ids'] ?? [],
                'executive_ids' => $data['executive_ids'] ?? [],
            ];
            $teamMembers = [];
            $this->projectRepository->addTeamMembers($data,$project_id,$teamMembers);
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder added new team member");
            $this->activityRepository->insert($project_id, $content);
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => '',
                'data' => $data
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @param $access_id
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function removeMember($id, $access_id)
    {
        try {
            DB::beginTransaction();
            $this->teamRepository->removeMember($access_id);
            DB::commit();
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder remove a team member");
            $this->activityRepository->insert($id, $content);
            return redirect()->back()->with(['success_msg' => 'Project has been deleted']);
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }


}

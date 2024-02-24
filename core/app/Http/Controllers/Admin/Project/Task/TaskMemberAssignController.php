<?php

namespace App\Http\Controllers\Admin\Project\Task;

use App\Constants\TaskType;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\Task\ITaskAssignToRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\SaveTaskRequest;
use App\Http\Requests\Admin\Project\Task\StoreAssignMemberRequest;
use App\Models\User;
use App\Utility\ActivityGenerator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

class TaskMemberAssignController extends Controller
{
    /**
     * @var ITaskRepository
     */
    private $taskRepository;
    private $activityRepository;
    /**
     * @var ITaskAssignToRepository
     */
    private $assignToRepository;
    /**
     * @var IProjectRepository
     */
    private $projectRepository;
    /**
     * @var IProjectTeamRepository
     */
    private $teamRepository;

    public function __construct(ITaskRepository $taskRepository, ITaskAssignToRepository $assignToRepository, IProjectRepository $projectRepository, IProjectTeamRepository $teamRepository, IProjectActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->taskRepository = $taskRepository;
        $this->assignToRepository = $assignToRepository;
        $this->projectRepository = $projectRepository;
        $this->teamRepository = $teamRepository;
    }

    public function create($id, $task_id)
    {
        try {
            if(!$this->projectRepository->exists($id) || !$this->taskRepository->exists($task_id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Page not found!',
                ]);
            }

            $department_id = $this->taskRepository->getDepartmentIdById($task_id);
            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.assign-member-modal', [
                    'members' => $this->teamRepository->getForDdl($id, $department_id)
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

    public function edit($id, $task_id, $assign_to_id)
    {
        try {
            if(!$this->projectRepository->exists($id) || !$this->taskRepository->exists($task_id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Page not found!',
                ]);
            }

            $department_id = $this->taskRepository->getDepartmentIdById($task_id);
            $assignedTask = $this->assignToRepository->getById($assign_to_id);
            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.assign-member-edit-modal', [
                    'members' => $this->teamRepository->getForDdl($id, $department_id),
                    'assignedTask' => $assignedTask
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

    public function store(StoreAssignMemberRequest $request, int $id, $task_id)
    {
        try {
            $model = $request->validated();
            if($this->assignToRepository->exists($task_id, $model['team_member_id']))
                return response()->json([
                    'status' => 400,
                    'message' => 'This member already assigned!',
                ]);
            $assignee_id = $this->assignToRepository->store($model, $task_id);
            $assignee = $this->assignToRepository->get($task_id, $model['team_member_id']);
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder assigned {$assignee->name} on this task.");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => (object)[
                    'name' => $assignee->name,
                    'photo' => asset($assignee->photo)
                ]
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function update(Request $request, int $id, $task_id)
    {
        try {
            $model = [
                'team_member_id' => $request->input('team_member_id'),
                'assigned_hour' => $request->input('assigned_hour'),
                'assigned_note' => $request->input('assigned_note')
            ];
            $oldAssignee = $this->assignToRepository->getById($request->input('assign_to_id'));
            if($this->assignToRepository->exists($task_id, $model['team_member_id']) &&  $oldAssignee->team_member_id != $model['team_member_id']){
                return response()->json([
                    'status' => 400,
                    'message' => 'This member already assigned!',
                ]);
            }
            $oldAssignee = $this->assignToRepository->getById($request->input('assign_to_id'));
            $assignee_id = $this->assignToRepository->update($model, $request->input('assign_to_id'));
            $assignee = $this->assignToRepository->get($task_id, $model['team_member_id']);
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder Update a assigned member from {$oldAssignee->name} to {$assignee->name} on this task.");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => (object)[
                    'name' => $assignee->name,
                    'photo' => asset($assignee->photo)
                ]
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    public function delete(Request $request, int $id, $task_id)
    {

        try {
            $assignToId = $request->input('assign_to_id');
            $assignedTo = $this->assignToRepository->getById($assignToId);
            $this->assignToRepository->delete($assignToId);
            //Insert Activity
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder removed {$assignedTo->name} from this task.");
            $this->activityRepository->insert($id, $content, $task_id);
            return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Project;

use App\Constants\Task\CommentType;
use App\Constants\Task\ListViewType;
use App\Constants\TaskStatus;
use App\Constants\TaskType;
use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\Task\ITaskArchiveRepository;
use App\Data\IRepositories\Projects\Task\ITaskAssignToRepository;
use App\Data\IRepositories\Projects\Task\ITaskCommentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskDetailsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Data\IRepositories\Projects\Task\ITaskTimeTrackerRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\ChangeTaskStatusRequest;
use App\Http\Requests\Admin\Project\Task\ConvertTaskRequest;
use App\Http\Requests\Admin\Project\Task\SaveTaskRequest;
use App\Http\Requests\Admin\Project\Task\UpdateTaskTrackerRequest;
use App\Utility\ActivityGenerator;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectTaskController extends Controller
{
    /**
     * @var IProjectServiceRepository
     */
    private $serviceRepository;
    /**
     * @var ITaskRepository
     */
    private $taskRepository;
    /**
     * @var ITaskAssignToRepository
     */
    private $assignToRepository;
    /**
     * @var IProjectTeamRepository
     */
    private $teamRepository;
    /**
     * @var IProjectRepository
     */
    private $projectRepository;
    /**
     * @var ITaskArchiveRepository
     */
    private $archiveRepository;
    /**
     * @var ITaskTimeTrackerRepository
     */
    private $taskTimeTrackerRepository;
    /**
     * @var ITaskDetailsRepository
     */
    private $detailsRepository;
    private $activityRepository;
    private $commentsRepository;
    private $userRepository;

    public function __construct(IProjectServiceRepository $serviceRepository,
    ITaskRepository $taskRepository,
    ITaskAssignToRepository $assignToRepository,
    ITaskDetailsRepository $detailsRepository,
    IProjectActivityRepository $activityRepository,
    IProjectTeamRepository $teamRepository,
    IProjectRepository $projectRepository,
    ITaskArchiveRepository $archiveRepository,
    ITaskTimeTrackerRepository $taskTimeTrackerRepository,
    ITaskCommentsRepository $commentsRepository,
    IUserRepository $userRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->taskRepository = $taskRepository;
        $this->assignToRepository = $assignToRepository;
        $this->teamRepository = $teamRepository;
        $this->projectRepository = $projectRepository;
        $this->archiveRepository = $archiveRepository;
        $this->taskTimeTrackerRepository = $taskTimeTrackerRepository;
        $this->detailsRepository = $detailsRepository;
        $this->activityRepository = $activityRepository;
        $this->commentsRepository = $commentsRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get tasks by the project
     *
     * @param int $id project_id
     * @return View
     * @throws Exception
     */
    public function index(int $id)//: View
    {
        try {
            $user_id = Auth::id();
            $user = $this->userRepository->getById($user_id);
            $view_type = request()->input('v');

            if($user->role == 'admin' || $user->role == 'Manager'){
                $tasks = $this->taskRepository->gets($id);
            }else{
                $tasks = $this->taskRepository->gets($id, TaskType::MAIN, 0, 0, $user_id);
            }

            foreach ($tasks as $task){
                if( $view_type == ListViewType::LIST)
                    $task->sub_tasks = $this->taskRepository->gets($id, TaskType::SUB, $task->id);

                $task->assignMembers = $this->assignToRepository->gets($task->id);
                if(count($task->sub_tasks) > 0){
                    foreach ($task->sub_tasks as $sub_task){
                        $sub_task->assignMembers = $this->assignToRepository->gets($sub_task->id);
                    }
                }
            }
            return view('admin.pages.project.task.index', [
                'tasks' => $tasks,
                'team_members' => $this->teamRepository->getForDdl($id)
            ]);

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create($id)
    {
        try {
            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.create-modal', [
                    'departments' => $this->serviceRepository->getServiceDepartments($id)
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

    public function store(SaveTaskRequest $request, int $id)
    {
        try {
            $model = $request->validated();
            $task_id = $this->taskRepository->store($model, $id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder created a task '{$model['task_name']}'");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => $task_id
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }


    public function edit($id, $task_id)
    {
        try {
            $task = $this->taskRepository->get($task_id, $id);
            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.edit-modal', [
                    'departments' => $this->serviceRepository->getServiceDepartments($id),
                    'task' => $task ,
                    'services' => $this->serviceRepository->getServicesByDepartment($id,  $task->dept_id)
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

    public function update(SaveTaskRequest $request, $id, $task_id)
    {
        try {

            $model = $request->validated();
            $task_id = $this->taskRepository->update($model, $id, $task_id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder updated a task '{$model['task_name']}'");
            $this->activityRepository->insert($id, $content, $task_id);

            return redirect()->back()->with('success_msg', "Task has been updated!");

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function approve($id, $task_id)
    {
        try {
            $task_id = $this->taskRepository->approved($task_id, $id);
            return response()->json([
                'status' => 200,
                'data' => $task_id
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function details(int $id, int $task_id)
    {
        try {
            $task = $this->taskRepository->get($task_id, $id);
            if(empty($task)){
                return response()->json([
                    'status' => 400,
                    'message' => 'Page not found!'
                ]);
            }

            if($task->task_type == TaskType::MAIN)
                $task->sub_tasks = $this->taskRepository->gets($id, TaskType::SUB, $task_id);

            $task->assignMembers = $this->assignToRepository->gets($task_id);
            $task->details = $this->detailsRepository->gets($task_id);
            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(!empty($assignee))
                $tracking_started_time = $this->taskTimeTrackerRepository->getStartedTime($assignee->id);
            else
                $tracking_started_time = null;

            return response()->json([
                'status' => 200,
                'data' => [
                    'type' => $task->task_type,
                    'tracker_start' => $tracking_started_time,
                    'model_view' => \view('admin.pages.project.task.task-details-modal', [
                        'task' => $task
                    ])->render()
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
    public function detailsView(int $id, int $task_id)
    {
        try {
            $task = $this->taskRepository->get($task_id, $id);
            if(empty($task)){
                return view('admin.shared.error', [
                    'error_msg' => 'Page not found!'
                ]);
            }

            if($task->task_type == TaskType::MAIN)
                $task->sub_tasks = $this->taskRepository->gets($id, TaskType::SUB, $task_id);

            $task->assignMembers = $this->assignToRepository->gets($task_id);
            $task->details = $this->detailsRepository->gets($task_id);
            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(!empty($assignee))
                $tracking_started_time = $this->taskTimeTrackerRepository->getStartedTime($assignee->id);
            else
                $tracking_started_time = null;
            return view('admin.pages.project.task.task-details', [
                'task' => $task,
                'type' => $task->task_type,
                'tracker_start' => $tracking_started_time,
            ]);

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
    public function reviewModal(int $id, int $task_id)
    {
        try {
            $task = $this->taskRepository->get($task_id, $id);
            if(empty($task)){
                return response()->json([
                    'status' => 400,
                    'message' => 'Page not found!'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' =>  \view('admin.pages.project.task.task-review-modal', [
                    'task' => $task
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
    public function SubmissionModal(int $id, int $task_id)
    {
        try {
            $task = $this->taskRepository->get($task_id, $id);
            if(empty($task)){
                return response()->json([
                    'status' => 400,
                    'message' => 'Page not found!'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' =>  \view('admin.pages.project.task.task-submission-modal', [
                    'task' => $task
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

    public function reviewComments(int $id, $task_id)
    {
        try {
            $comments = $this->commentsRepository->gets($task_id, CommentType::REVIEW);
            return response()->json([
                'status' => 200,
                'data' => view('admin.pages.project.task.inc.details._display-comments', [
                    'comments' => $comments
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
    public function submissionComments(int $id, $task_id)
    {
        try {
            $comments = $this->commentsRepository->gets($task_id, CommentType::SUBMISSION);
            return response()->json([
                'status' => 200,
                'data' => view('admin.pages.project.task.inc.details._display-comments', [
                    'comments' => $comments
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

    public function getSubtask($id, $task_id): JsonResponse
    {
        try {
            $sub_tasks = $this->taskRepository->getSubtasks($task_id);
            foreach ($sub_tasks as $sub_task){
                $sub_task->assignMembers = $this->assignToRepository->gets($sub_task->id);
            }
            return response()->json([
                'status' => 200,
                'data' => [
                    'sub_tasks' => \view('admin.pages.project.task.inc.details._sub-task', [
                        'sub_tasks' => $sub_tasks,
                        'task_id' => $task_id
                    ])->render()
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

    public function changeName(Request $request, int $id, int $task_id): JsonResponse
    {
        try {
            $task_name = $request->input('task_name');
            $this->taskRepository->updateInfo(['task_name' => $task_name], $task_id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder changed the task name to '$task_name'");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

  public function saveDescription(Request $request, int $id, int $task_id): JsonResponse
    {
        try {
            $this->taskRepository->updateInfo(['description' => $request->input('task_description')], $task_id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder changed the task description");
            $this->activityRepository->insert($id, $content, $task_id);
            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    /**
     * @param ChangeTaskStatusRequest $request
     * @param int $id project Id
     * @param int $task_id
     * @return JsonResponse
     */
    public function changeStatus(ChangeTaskStatusRequest $request, int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }
            $model = $request->validated();
            $this->taskRepository->changeStatus($model, $task_id);

            //Insert Activity
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $status = TaskStatus::ConvertNumberToText($model['status']);
            $content = ActivityGenerator::getContent("$placeholder changed status to '$status'");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => view('admin.pages.project.task.inc._task-statuses', [
                    'task' => (object)['status' => $model['status'], 'id' => $task_id],
                    'is_details' => 1
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

    public function changeAcceptanceStatus($id, $task_id)
    {
        try {
            $this->taskRepository->changeAcceptanceStatus($task_id, request()->input('status'));
            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function checkTimeTracker()
    {
        try {
            $tracking_started_time = $this->taskTimeTrackerRepository->getStartedTimeByUserId(Auth::id());
            $task_info = $this->taskRepository->getTrackerActiveTask(Auth::id());
            return response()->json([
                'status' => 200,
                'tracker' => $tracking_started_time,
                'task_info' => $task_info
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function startTimer(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(empty($assignee))
                return response()->json([
                    'status' => 400,
                    'message' => 'You not assigned on this task'
                ]);

            $activeTracker = $this->taskTimeTrackerRepository->activeTimerByUserId(Auth::id());
            if(!empty($activeTracker))
                return response()->json([
                    'status' => 400,
                    'message' => 'Already have an active timer.'
                ]);

            $startedTime = Carbon::now();
            $this->taskTimeTrackerRepository->startTime($startedTime, $assignee->id);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder started the time tracker");
             $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => $startedTime
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function stopTimer(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(empty($assignee))
                return response()->json([
                    'status' => 400,
                    'message' => 'You not assigned on this task'
                ]);

            $activeTracker = $this->taskTimeTrackerRepository->activeTimer($assignee->id);
            if(empty($activeTracker))
                return response()->json([
                    'status' => 400,
                    'message' => 'Active timer not found!'
                ]);

            $startedTime = Carbon::now();
            $this->taskTimeTrackerRepository->stopTimer($startedTime, $assignee->id, \request()->input('note'));

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder stopped the time tracker");
             $this->activityRepository->insert($id, $content, $task_id);
            return response()->json([
                'status' => 200,
                'data' => $startedTime
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function addHour(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(empty($assignee))
                return response()->json([
                    'status' => 400,
                    'message' => 'You not assigned on this task'
                ]);

            $hour = request()->input('hour');
            $this->taskTimeTrackerRepository->addHour($hour, $assignee->id);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder added hour manualy on time tracker");
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

    public function saveManualTracking(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $assignee = $this->assignToRepository->get($task_id, Auth::id());
            if(empty($assignee))
                return response()->json([
                    'status' => 400,
                    'message' => 'You not assigned on this task'
                ]);

            $fromTime = request()->input('fromTime');
            $endTime = request()->input('endTime');
            $this->taskTimeTrackerRepository->addManual($fromTime, $endTime, $assignee->id);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder added time manualy on time tracker");
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

    public function editTracker(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $tracker_id = request()->input('tracker_id');

            $tracker = $this->taskTimeTrackerRepository->get($tracker_id);
            if(empty($tracker)){
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }
            return response()->json([
                'status' => 200,
                'data' => view('admin.pages.project.task.tracker-edit-form', [
                    'tracker' => $tracker
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

    public function updateTracker(int $id, int $task_id, UpdateTaskTrackerRequest $request){
        try {
            $model = $request->validated();
            $this->taskTimeTrackerRepository->update($model);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder updated tracker");
            $this->activityRepository->insert($id, $content, $task_id);


             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder updated time tracker");
             $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => $task_id
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function removeTracker(int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $tracker_id = request()->input('tracker_id');

            $this->taskTimeTrackerRepository->remove($tracker_id);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder removed time tracker");
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

    public function archiveModal($id, $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.archive-task-modal')->render()
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function archive(Request $request, int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $note = $request->input('note');
            $this->archiveRepository->store($task_id, $request->input('note'));

            $taskName = $this->taskRepository->getName($task_id);

            //Insert Activity
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder archived task '$taskName->task_name' with note: $note");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function convertTask($id, $task_id)
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.convert-task-modal', [
                    'main_tasks' => $this->taskRepository->getMainTasks($task_id, $id)
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

    public function getWorkingHours($id, $task_id)
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.working-hour-modal', [
                    'hours' => $this->taskTimeTrackerRepository->getByTask($task_id)
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

    public function convertTaskStore(ConvertTaskRequest $request, int $id, int $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            $model = $request->validated();
            if ($model['task_type'] == TaskType::SUB && $this->taskRepository->haveAnySubTask($task_id)){
                return response()->json([
                    'status' => 400,
                    'message' => 'This task have one more sub-task available. So you can\'t convert sub task.'
                ]);
            }
            $this->taskRepository->convertTask($request->validated(), $task_id);

            //Insert Activity
            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $task_type = $model['task_type'] == TaskType::SUB ? 'sub-task' : 'main task';
            $content = ActivityGenerator::getContent("$placeholder converted as $task_type");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function calendarViewFilter($id, $task_status, $task_date)
    {
        $tasks = $this->taskRepository->tasksByDate($id, $task_date, $task_status);
        return response()->json([
            'status' => 200,
            'data' => \view('admin.pages.project.task.modals._calendar-task-list-view', compact('tasks'))->render()
        ]);
    }

    public function getActivities($id, $task_id): JsonResponse
    {
        try {
            if(!$this->projectRepository->exists($id))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Not found'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' => \view('admin.pages.project.task.inc.details.task-activities', [
                    'activities' => $this->activityRepository->getsByTask($id, $task_id)
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

    public function taskByProject($id)
    {
        try {
            $tasks = $this->taskRepository->gets($id, 0, 0, 'INCOMPLETE', Auth::id() );

            return response()->json([
                'status' => 200,
                'data' => \view('admin/dashboard/inc/timetracker-tasks-list', compact('tasks'))->render()
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

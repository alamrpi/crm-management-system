<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ProjectStatus;
use App\Constants\TaskStatus;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private $projectRepository;
    private $taskRepository;

    public function __construct(
        IProjectRepository $ProjectRepository,
        ITaskRepository $taskRepository
    ){
        $this->projectRepository = $ProjectRepository;
        $this->taskRepository = $taskRepository;
    }
    public function index()//: View
    {
        $user = Auth::user();
        $projects = $this->projectRepository->getProjectsByUserId($user->id);
        if ($user->role === 'admin') {
            return view('admin.dashboard.dashboard');

        }elseif($user->role === 'Manager'){
            $revision_tasks = $this->taskRepository->getRevisionTask($projects->pluck('id')->toArray());
            return view('admin.dashboard.employee-dashboard', compact('projects', 'revision_tasks'));
        }else{
            $user_id = Auth::id();
            $user_projects = $this->projectRepository->getProjectsByUserId($user_id);
            $todayCompletedHour =  $this->taskRepository->getTodayTotalHourByUserId(Auth::id());
            return view('admin.dashboard.executive-dashboard',compact('projects', 'user_projects', 'todayCompletedHour'));

        }
    }

    public function getProjectsbyStatus(){
        try {
            $projects = $this->projectRepository->getAllProjects();
            $projectGroup = [
                'not_started' => '',
                'in_progress' => '',
                'completed' => '',
            ];
            foreach( $projects->groupBy('status') as $key => $group){
                switch($key)
                {
                    case ProjectStatus::NEW:
                        $projectGroup['not_started'] = $group->count();
                        break;
                    case ProjectStatus::IN_PROGRESS:
                        $projectGroup['in_progress'] = $group->count();
                        break;
                    case ProjectStatus::COMPLETED:
                        $projectGroup['completed'] = $group->count();
                        break;
                    default:
                        break;
                }
            }
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => view('admin.dashboard.inc._project-count',compact('projectGroup', 'projects'))->render()
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function overDueTasks()
    {
        try{
            $recordPerPage = 3;
            $overDueTasks = $this->taskRepository->getOverDueTasks($recordPerPage);
            $overDueTasks = $this->taskRepository->getMultiTaskTimes($overDueTasks);
            return response()->json([
                'status'    => 200,
                'message'   => 'success',
                'count'     =>$this->taskRepository->getOverDueTasks()->count(),
                'data'      => view('admin.dashboard.inc._over-due-tasks',compact('overDueTasks'))->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    public function nextDueTasks()
    {
        try{
            $recordPerPage = 10;
            $nextDueTasks = $this->taskRepository->getNextDueTasks($recordPerPage);
            $nextDueTasks = $this->taskRepository->getMultiTaskTimes($nextDueTasks);
            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'count'         => $this->taskRepository->getNextDueTasks()->count(),
                'data'          => view('admin.dashboard.inc._next-due-tasks',compact('nextDueTasks'))->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    public function todayDueTasks()
    {
        try{
            $recordPerPage = 3;
            $todayDueTasks = $this->taskRepository->getTodayDueTasks($recordPerPage);
            $todayDueTasks = $this->taskRepository->getMultiTaskTimes($todayDueTasks);
            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'count'         => $this->taskRepository->getTodayDueTasks()->count(),
                'data'          => view('admin.dashboard.inc._today-due-tasks',compact('todayDueTasks'))->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function projectTasksChart()
    {
        try{
            $month = request()->input('month') ?? date('Y-m');
            $projectId = request()->input('project_id');
            $ragne = range(1, date('t', mktime(0, 0, 0, date('m', strtotime($month)), 1, date('Y', strtotime($month)))));
            $completedTasks = $this->taskRepository->getTaskByMonthWithStatus($projectId, TaskStatus::COMPlETE, $month)->groupBy('due_date');
            $inCompletedTasks = $this->taskRepository->getTaskByMonthWithStatus($projectId, 0, $month)->groupBy('due_date');
            $completedTasksCount = [];
            $inCompletedTasksCount = [];
            foreach($ragne as $r){
                $keyword = strlen($r) > 1 ? $month.'-'.$r : $month.'-0'.$r;
                $inCompletedTasksCount[$r] = Arr::exists($inCompletedTasks, $keyword) ? $inCompletedTasks[$keyword]->count() : 0;
                $completedTasksCount[$r] = Arr::exists($completedTasks, $keyword) ? $completedTasks[$keyword]->count() : 0;
            }
            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'completed'     => $completedTasksCount,
                'inCompleted'   => $inCompletedTasksCount,
                'range'         =>$ragne
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    public function nextDayTasks($userId)
    {
        try{
            $tasks = $this->taskRepository->nextDayTasksByUserId($userId);
            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'data'          => view('admin/dashboard/inc/_next-day-tasks', compact('tasks'))->render(),
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function feedbacks(): View
    {
        return view('admin.pages.feedback.index');
    }

    public function tasks(): View
    {
        return view('admin.pages.task.index');
    }   public function tasksCalendar(): View
    {
        return view('admin.pages.task.calendar');
    }

    public function requests(): View
    {
        return view('admin.pages.request.index');
    }

    public function requestDetails(): View
    {
        return view('admin.pages.request.details');
    }

    public function notes(): View
    {
        return view('admin.pages.notes.index');
    }

}

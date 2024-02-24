<?php

namespace App\Http\Controllers\Client;

use App\Constants\TaskStatus;
use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Utility\Client\ClientHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private $clientRepository;
    private $projectRepository;
    private $taskRepository;
    private $projectTeamRepository;

    private $employeeRepository;

    private $activityRepository;
    private $documentRepository;

    public function __construct(
        IClientRepository $clientRepository,
        IProjectRepository $projectRepository,
        ITaskRepository $taskRepository,
        IProjectTeamRepository $projectTeamRepository,
        IEmployeeRepository $employeeRepository,
        IProjectActivityRepository $activityRepository,
        IProjectDocumentRepository $documentRepository
    )
    {
        $this->clientRepository = $clientRepository;
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
        $this->projectTeamRepository = $projectTeamRepository;
        $this->employeeRepository = $employeeRepository;
        $this->activityRepository = $activityRepository;
        $this->documentRepository = $documentRepository;
    }

    public function welcome(): View
    {

        $current_project = ClientHelper::getCurrentProject();
        return view('client.welcome',['current_project'=>$current_project]);
    }

    public function switchProject(): RedirectResponse
    {
        $previous_path = request()->input('previous_path') ?? '';
        $previousRoute = Route::getRoutes()->match(Request::create($previous_path, 'get'))->getName();
        $project_id = request()->input('pid') ?? 0;
        $current_project = ClientHelper::getCurrentProject($project_id);
        if (str_contains($previousRoute, 'clientarea/project/'))
            return redirect()->route($previousRoute,['slug' => $current_project['slug']]);
        return redirect()->route('clientarea/project/dashboard',['slug' => $current_project['slug']]);
    }

    public function dashboard(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        return view('client.dashboard.dashboard', compact('current_project'));
    }

    public function workStatus(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        $teamMembers = $this->projectTeamRepository->gets($current_project['id']);
        $allTasks = $this->taskRepository->gets($current_project['id']);
        return view('client.pages.project.work-status', compact('current_project','teamMembers', 'allTasks'));
    }

    public function team(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        $recordPerPage = 15;
        $teamMembers = $this->projectTeamRepository->getsWithPagination($current_project['id'], $recordPerPage);
        $employeeTypes = $this->employeeRepository->getAllEmployeeType();
        return view('client.pages.team.index',compact('current_project', 'teamMembers', 'employeeTypes'));
    }
    public function teamMemberProfile($slug, $id): View
    {
        $current_project = ClientHelper::getCurrentProject();
        $profile = $this->employeeRepository->profileByUserId($id);
        $projects = $this->projectRepository->getProjectsByUserId($id);
        $project_activities = $this->activityRepository->getsByUser($id, 10);

        $files = $this->documentRepository->getAllFilesByUserId($id);
        return view('client.pages.team.profile',compact('current_project', 'profile', 'projects', 'project_activities', 'files'));
    }

    public function teamProfile(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        return view('client.pages.team.profile', compact('current_project'));
    }

    public function chat(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        return view('client.pages.chat.index', compact('current_project'));
    }

    public function integratedReport(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        return view('client.pages.report.integrated-report',['current_project'=>$current_project]);
    }

    public function keywordRankingReport(): View
    {
        $current_project = ClientHelper::getCurrentProject();
        return view('client.pages.report.keyword-ranking-report',['current_project'=>$current_project]);
    }



    public function lastCompletedTasks(): JsonResponse
    {
        try {
            $current_project = ClientHelper::getCurrentProject();
            $recordPerPage  = 5;
            $tasks = $this->taskRepository->getLastCompletedTasks($recordPerPage, $current_project['id']);
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => view('common.js-rander.dashboard.__last-completed-tasks', compact('tasks'))->render()
            ]);
        }catch(Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function nextDueTasks(): JsonResponse
    {
        try {
            $current_project = ClientHelper::getCurrentProject();
            $recordPerPage  = 5;
            $tasks = $this->taskRepository->getNextDueTasks($recordPerPage, $current_project['id']);
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => view('common.js-rander.dashboard._next-due-task', compact('tasks'))->render()
            ]);
        }catch(Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function taskOverviewChart(): JsonResponse
    {
        try{
            $month = request()->input('month') ?? date('Y-m');
            $projectId = ClientHelper::getCurrentProject()['id'];
            $ragne = range(1,cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')));

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

    public function projectTaskStatusChart(): JsonResponse
    {
        try{
            $projectId = ClientHelper::getCurrentProject()['id'];
            $completedTasks = $this->taskRepository->gets($projectId, 0, 0, TaskStatus::COMPlETE);
            $inCompletedTasks = $this->taskRepository->gets($projectId, 0, 0, 1);
            $totalTasks = $this->taskRepository->gets($projectId, 0);

            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'completed'     => $totalTasks->count() !=0 ? round($completedTasks->count()/$totalTasks->count()*100, 2, PHP_ROUND_HALF_DOWN) : 0,
                'inCompleted'   => $totalTasks->count() !=0 ?round($inCompletedTasks->count()/$totalTasks->count()*100, 2, PHP_ROUND_HALF_DOWN) : 0,
                'total'         => $totalTasks->count(),
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function projectTaskHourStatusChart(): JsonResponse
    {
        try{
            $projectId = ClientHelper::getCurrentProject()['id'];
            $totalTasks = $this->taskRepository->getTotalTask(0,$projectId,'hour');
            $completedTasks = $this->taskRepository->getCompleteTask(0, $projectId, 'hour');
            $inCompletedTasks = $totalTasks - $completedTasks;
            return response()->json([
                'status'        => 200,
                'message'       => 'success',
                'completed'     => $totalTasks != 0 ? round($completedTasks/$totalTasks *100, 2, PHP_ROUND_HALF_DOWN) : 0,
                'inCompleted'   => $totalTasks!=0 ? round($inCompletedTasks/$totalTasks *100, 2, PHP_ROUND_HALF_DOWN): 0,
                'total'         => $totalTasks,
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
}

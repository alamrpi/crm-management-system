<?php

namespace App\Http\Controllers\Admin;

use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\Task\ITaskTimeTrackerRepository;
use App\Http\Controllers\Controller;
use App\Utility\Helpers;
use Illuminate\Support\Facades\Auth;

class TimeAndActivityController extends Controller
{
    /**
     * @var IProjectRepository
     */
    private $projectRepository;
    /**
     * @var IProjectTeamRepository
     */
    private $projectTeamRepository;
    /**
     * @var ITaskTimeTrackerRepository
     */
    private $timeTrackerRepository;

    function __construct(IProjectRepository $projectRepository, IProjectTeamRepository $projectTeamRepository, ITaskTimeTrackerRepository $timeTrackerRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->projectTeamRepository = $projectTeamRepository;
        $this->timeTrackerRepository = $timeTrackerRepository;
    }
    public function index()
    {
        $recordPerPage = 100;
        $members = [];
        if(Auth::user()->role == 'admin'){
            $projects = $this->projectRepository->getForDdl();
            $members = $this->projectTeamRepository->getAllForDdl();
            $rows = $this->timeTrackerRepository->gets($recordPerPage);
        }else{
            $projects = $this->projectRepository->getForDdl(Auth::id());
            $rows = $this->timeTrackerRepository->gets($recordPerPage, Auth::id());
        }
        return view('admin/pages/time-activity/index', [
            'projects' => $projects,
            'members' => $members,
            'rows' => $rows
        ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));
    }
}

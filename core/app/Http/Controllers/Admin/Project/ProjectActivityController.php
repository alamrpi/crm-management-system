<?php

namespace App\Http\Controllers\Admin\Project;

use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Http\Controllers\Controller;
use App\Utility\Helpers;
use Illuminate\View\View;

class ProjectActivityController extends Controller
{
    /**
     * @var IProjectActivityRepository
     */
    private $projectActivityRepository;
    /**
     * @var IEmployeeRepository
     */
    private $employeeRepository;

    public function __construct(IProjectActivityRepository $projectActivityRepository, IEmployeeRepository $employeeRepository)
    {
        $this->projectActivityRepository = $projectActivityRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param int $id project_id
     * @return View
     */
    public  function index(int $id): View
    {
        try {
            $recordPerPage = 20;
            return view('admin.pages.project.activity.index', [
                'employees' => $this->employeeRepository->getForDDL(),
                'rows' => $this->projectActivityRepository->gets($recordPerPage, $id)
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

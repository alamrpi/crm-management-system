<?php

namespace App\View\Components\Project\Team;

use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use Illuminate\View\Component;

class AssignMember extends Component
{
    private $departmentRepository;

    /**
     * @var int
     */
    private $projectId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IDepartmentRepository $departmentRepository, $projectId)
    {
        $this->departmentRepository = $departmentRepository;
        $this->projectId = $projectId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project.team.assign-member',[
            'project_departments' => $this->departmentRepository->getAll(),
            'project_id' => $this->projectId
        ]);
    }
}

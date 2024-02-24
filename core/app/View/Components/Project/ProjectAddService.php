<?php

namespace App\View\Components\Project;

use App\Data\IRepositories\IDepartmentRepository;
use Hamcrest\Thingy;
use Illuminate\View\Component;

class ProjectAddService extends Component
{
    /**
     * @var IDepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var string
     */
    private $formUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IDepartmentRepository $departmentRepository, string $formUrl)
    {
        //
        $this->departmentRepository = $departmentRepository;
        $this->formUrl = $formUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project.project-add-service', [
            'departments' => $this->departmentRepository->getAll(),
            'url' => $this->formUrl
        ]);
    }
}

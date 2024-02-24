<?php

namespace App\View\Components\Project;

use App\Data\IRepositories\Projects\IProjectRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class TopView extends Component
{
    /**
     * @var IProjectRepository
     */
    private $projectRepository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project.top-view', [
            'project_view' => $this->projectRepository->getByIdForTopView(Route::input('id'))
        ]);
    }
}

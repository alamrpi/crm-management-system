<?php

namespace App\View\Components\Project;

use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Utility\Helpers;
use Illuminate\View\Component;

class Services extends Component
{
    /**
     * @var IProjectServiceRepository
     */
    private $serviceRepository;
    /**
     * @var string
     */
    private $from;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IProjectServiceRepository $serviceRepository, string $from)
    {
        //
        $this->serviceRepository = $serviceRepository;
        $this->from = $from;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project.services', [
            'services' => $this->serviceRepository->getServices(Helpers::getParamValue('id')),
            'from' => $this->from
        ]);
    }
}

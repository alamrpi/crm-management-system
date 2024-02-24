<?php

namespace App\View\Components\Client;

use App\Data\IRepositories\Projects\IProjectRepository;
use App\Models\Client;
use App\Models\Project\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Sidebar extends Component
{
    private $projectId;
    private $projectRepository;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IProjectRepository$projectRepository, $projectId)
    {
        $this->projectRepository = $projectRepository;
        $this->projectId = $projectId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user_id = Auth::user()->id;
        $client_id = Client::where('user_id', $user_id)->first()->id;
        $projects = Project::where('client_id', $client_id)->select('id','slug', 'project_name')->get();
        $current_project = Project::where('id', $this->projectId)->first()->toArray();
        return view('components.client.sidebar',[
            'projects' => $projects,
            'current_project' => $current_project
        ]);
    }
}

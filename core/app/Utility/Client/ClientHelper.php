<?php

namespace App\Utility\Client;

use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Models\Client;
use App\Models\Project\Project;
use App\Utility\Helpers;
use Illuminate\Support\Facades\Auth;

class ClientHelper
{
    public static function getCurrentProject($projectId = null){
        $projectSlug = Helpers::getParamValue('slug') ?? 0;
        $client = Client::query()
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('client_enrolls', 'clients.id', '=', 'client_enrolls.client_id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('clients.id', 'clients.address','clients.company_name', 'users.photo', 'users.name', 'users.email')
            ->first();
        if ($projectSlug) {
            $project = Project::where('slug', $projectSlug)->where('client_id', '=', $client->id);
            if ($project->count()){
                return $project->first()->toArray();
            }else{
                Helpers::throughError('You didn\'t select a project ! Please Select A Project!',  4444);
            }
        }
        if ($projectId !== null) {
            $project = Project::where('id', '=',$projectId)->where('client_id', '=', $client->id);
            if ($project->count()){
                return $project->first()->toArray();
            }else{
                Helpers::throughError('Invalid Project ! Please Select A Project!',  4444);
            }
        }
        return $current_project = Project::where('projects.client_id', '=', $client->id)
            ->orderBy('projects.id', 'desc')->first()->toArray();
    }
}

<?php

namespace App\Data\Repositories\Projects;

use App\Data\IRepositories\Projects\IProjectAccessRepository;
use App\Data\IRepositories\Projects\IProjectAccessRequestRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ProjectAccessRequestRepository implements IProjectAccessRequestRepository
{
    public function gets($project_id): Collection
    {
        $query = $this->getQuery($project_id)
            ->orderBy('project_access_requests.id')
            ->select('project_access_requests.*', 'project_accesses.id as access_id');

        return $query->get();
    }

    public function getsForDdl($project_id, $access_id = null): Collection
    {
        $query = $this->getQuery($project_id)
            ->orderBy('project_access_requests.id')
            ->select('project_access_requests.id', 'project_access_requests.request_title', 'project_accesses.id as access_id');

        if($access_id != null)
        {
            $query->where('project_accesses.id', '=', null)
                ->orWhere('project_accesses.id', '=', $access_id);
        }
        else{
            $query->where('project_accesses.id', '=', null);
        }
        return $query->get();
    }
    public function store(array $model, $id): int
    {
        return DB::table('project_access_requests')->insertGetId([
            'project_id' => $id,
            'request_title' => $model['request_title'],
            'request_details' => $model['request_details'],
            'created_by' => Auth::id(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }


    public function delete($id, $access_id)
    {
        DB::table('project_access_requests')
            ->where('id', $access_id)
            ->where('project_id', $id)
            ->delete();
    }

    public function getById($id, $access_id)
    {
        return DB::table('project_access_requests')
            ->where('project_access_requests.project_id', '=', $id)
            ->where('project_access_requests.id', '=', $access_id)
            ->first();
    }

    public function update(array $model, $id, $access_id)
    {
        DB::table('project_access_requests')->where('id', $access_id)->update([
            'request_title' => $model['request_title'],
            'request_details' => $model['request_details'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param $project_id
     * @return Builder
     */
    public function getQuery($project_id): Builder
    {
        return DB::table('project_access_requests')
            ->leftJoin('project_accesses', 'project_access_requests.id', '=', 'project_accesses.request_id')
            ->where('project_access_requests.project_id', '=', $project_id);
    }
}

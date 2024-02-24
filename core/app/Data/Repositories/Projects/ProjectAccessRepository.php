<?php

namespace App\Data\Repositories\Projects;

use App\Data\IRepositories\Projects\IProjectAccessRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ProjectAccessRepository implements IProjectAccessRepository
{
    public function gets($project_id): Collection
    {
        $query = DB::table('project_accesses')
            ->where('project_accesses.project_id', '=', $project_id)
            ->leftJoin('project_access_requests', 'project_accesses.request_id', '=', 'project_access_requests.id')
            ->orderBy('project_accesses.id')
            ->select('project_accesses.*', 'project_access_requests.request_title');

        return $query->get();
    }
    public function store(array $model, $id): int
    {
        return DB::table('project_accesses')->insertGetId([
            'project_id' => $id,
            'access_title' => $model['access_title'],
            'request_id' => $model['request_id'],
            'access_details' => $model['access_details'],
            'file_info' => $model['file_info'],
        ]);
    }


    public function delete($id, $access_id)
    {
        DB::table('project_accesses')->where('id', $access_id)->where('project_id', $id)->delete();
    }

    public function getById($id, $access_id)
    {
        return DB::table('project_accesses')
            ->where('project_accesses.project_id', '=', $id)
            ->where('project_accesses.id', '=', $access_id)
            ->first();
    }

    public function update(array $model, $id, $access_id)
    {
        DB::table('project_accesses')->where('id', $access_id)->update([
            'access_title' => $model['access_title'],
            'request_id' => $model['request_id'],
            'access_details' => $model['access_details'],
            'file_info' => $model['file_info'],
        ]);
    }
}

<?php

namespace App\Data\Repositories\Projects;

use App\Data\IRepositories\Projects\IProjectIntegrationKeywordRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ProjectIntegrationKeywordRepository implements IProjectIntegrationKeywordRepository
{
    public function gets($project_id): Collection
    {
        $query = DB::table('integration_keywords')
            ->where('integration_keywords.project_id', '=', $project_id)
            ->orderByDesc('integration_keywords.id')
            ->select('integration_keywords.*', DB::raw('(SELECT COUNT(*) FROM integration_keyword_keywords WHERE integration_keyword_keywords.integration_keyword_id = integration_keywords.id) as keywords'));

        return $query->get();
    }

    public function getKeywords(int $cid): Collection
    {
        return DB::table('integration_keyword_keywords')
        ->where('integration_keyword_id', $cid)
        ->get();
    }

    public function get(int $project_id, $cid){
        return DB::table('integration_keywords')
            ->where('integration_keywords.project_id', '=', $project_id)
            ->where('id', $cid)
            ->first();

    }

    public function store(int $project_id, $website){
        return DB::table('integration_keywords')->insertGetId([
            'website' => $website,
            'project_id' => $project_id
        ]);
    }

    public function update(int $project_id, $cid, $website){
        DB::table('integration_keywords')->where('id', $cid)->where('project_id', $project_id)->update([
            'website' => $website,
        ]);
    } 
    
    public function updateIdKey($id, $cid, $model){
        DB::table('integration_keywords')->where('id', $cid)->where('project_id', $id)->update($model);
    }

    public function keywordAddOrUpdate(int $project_id, $cid, $model)
    {
        if($model['keyword_id'] == 0){
            DB::table('integration_keyword_keywords')->insert([
                'keyword_name' => $model['keyword_name'],
                'integration_keyword_id' => $cid
            ]);
        }else{
            DB::table('integration_keyword_keywords')->where('integration_keyword_id', $cid)->where('id', $model['keyword_id'])
            ->update([
                'keyword_name' => $model['keyword_name']
            ]);
        }
    }

    public function keywordDelete(int $project_id, $cid, $keyword_id){
        DB::table('integration_keyword_keywords')->where('integration_keyword_id', $cid)->where('id', $keyword_id)->delete();
    }
}

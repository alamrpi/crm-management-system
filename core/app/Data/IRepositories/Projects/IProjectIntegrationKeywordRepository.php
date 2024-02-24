<?php

namespace App\Data\IRepositories\Projects;

use Illuminate\Support\Collection;
interface IProjectIntegrationKeywordRepository
{
    public function gets(int $project_id): Collection;
    public function getKeywords(int $cid): Collection;
    public function keywordAddOrUpdate(int $project_id, $cid, $model);
    public function keywordDelete(int $project_id, $cid, $keyword_id);
    public function get(int $project_id, $cid);
    public function store(int $project_id, $website);
    public function update(int $project_id, $cid, $website);
    public function updateIdKey($id, $cid, $model);
}

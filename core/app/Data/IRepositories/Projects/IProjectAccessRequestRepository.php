<?php

namespace App\Data\IRepositories\Projects;

use Illuminate\Support\Collection;
interface IProjectAccessRequestRepository
{
    public function store(array $model, $id): int;

    public function delete($id, $access_id);

    public function gets(int $project_id): Collection;
    public function getsForDdl($project_id, $access_id = null): Collection;

    public function getById($id, $access_id);

    public function update(array $model, $id, $access_id);
}

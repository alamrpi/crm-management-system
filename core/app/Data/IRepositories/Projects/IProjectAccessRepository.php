<?php

namespace App\Data\IRepositories\Projects;

use Illuminate\Support\Collection;
interface IProjectAccessRepository
{
    public function store(array $model, $id): int;

    public function delete($id, $access_id);

    public function gets(int $project_id): Collection;

    public function getById($id, $access_id);

    public function update(array $model, $id, $access_id);
}

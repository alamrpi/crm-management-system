<?php

namespace App\Data\IRepositories\Projects\Task;

use Illuminate\Support\Collection;

interface ITaskAttachmentsRepository
{
    public function store($model);

    public function get(int $id, $task_id);

    public function gets(int $task_id): Collection;

    public function delete($id, $task_id);
}

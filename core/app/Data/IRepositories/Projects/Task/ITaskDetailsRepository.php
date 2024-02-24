<?php

namespace App\Data\IRepositories\Projects\Task;

interface ITaskDetailsRepository
{
    public function store($model, int $task_id):int;

    public function get(int $details_id, $task_id);

    public function gets(int $task_id);

    public function delete($id, $task_id);
}

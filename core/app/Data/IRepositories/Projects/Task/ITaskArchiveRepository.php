<?php

namespace App\Data\IRepositories\Projects\Task;

interface ITaskArchiveRepository
{
    public function store($task_id, $note);
}

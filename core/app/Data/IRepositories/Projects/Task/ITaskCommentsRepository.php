<?php

namespace App\Data\IRepositories\Projects\Task;

use App\Constants\Task\CommentType;
use Illuminate\Support\Collection;

interface ITaskCommentsRepository
{
    public function store($task_id, $message, $attachment, $type = CommentType::GENERAL);

    public function get(int $id, $task_id);

    public function gets($task_id, $type = CommentType::GENERAL): Collection;

    public function delete($id, $task_id);
}

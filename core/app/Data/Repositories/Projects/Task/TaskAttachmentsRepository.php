<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskAttachmentsRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaskAttachmentsRepository implements ITaskAttachmentsRepository
{
    public function store($model)
    {
        DB::table('task_attachments')->insert($model);
    }

    public function get(int $id, $task_id)
    {
        return DB::table('task_attachments')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->first();
    }

    public function gets(int $task_id): Collection
    {
        return DB::table('task_attachments')
            ->join('users', 'task_attachments.created_by', '=', 'users.id')
            ->where('task_id', $task_id)
            ->select('task_attachments.*', 'users.photo', 'users.name as user_name')
            ->get();
    }

    public function delete($id, $task_id)
    {
        DB::table('task_attachments')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->delete();

    }
}

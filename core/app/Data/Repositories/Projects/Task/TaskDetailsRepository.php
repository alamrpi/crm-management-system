<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskDetailsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskDetailsRepository implements ITaskDetailsRepository
{
    public function store($model, int $task_id): int
    {
        return DB::table('task_details')->insertGetId([
            'task_id' => $task_id,
            'field_name' => $model['field_name'],
            'field_value' => $model['field_value'],
            'created_by' => Auth::id(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function get(int $details_id, $task_id)
    {
        return DB::table('task_details')
            ->where('id', $details_id)
            ->where('task_id', $task_id)
            ->first();

    }

    public function gets(int $task_id)
    {
        return DB::table('task_details')
            ->where('task_id', $task_id)
            ->get();
    }

    public function delete($id, $task_id)
    {
        DB::table('task_details')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->delete();

    }
}

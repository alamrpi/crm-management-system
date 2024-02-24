<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskArchiveRepository;
use App\Utility\Helpers;
use Illuminate\Support\Facades\DB;

class TaskArchiveRepository implements ITaskArchiveRepository
{
    public function store($task_id, $note): int
    {
       return DB::table('task_archives')->insertGetId([
           'task_id' => $task_id,
           'archiving_by' => Helpers::getUserId(),
           'archived_time' => date('Y-m-d H:i:s'),
           'note' => $note
        ]);
    }
}

<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskAssignToRepository;
use App\Utility\Helpers;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaskAssignToRepository implements ITaskAssignToRepository
{
    /**
     * @param int $taskId
     * @return Collection
     * @throws Exception
     */
    public function gets(int $taskId): Collection
    {
        try {
            return DB::table('task_assign_tos')
                ->join('users', 'task_assign_tos.team_member_id', '=', 'users.id')
                ->join('employees', 'users.id', '=', 'employees.user_id')
                ->where('task_assign_tos.task_id', $taskId)
                ->select('users.id as user_id', 'users.name', 'users.photo', 'task_assign_tos.id', 'task_assign_tos.assigned_hour', 'employees.designation',
                    DB::raw('(SELECT SUM(task_time_trackers.working_hour) FROM task_time_trackers WHERE task_time_trackers.assigned_id = task_assign_tos.id) as working_hour')
                )
                ->get();

        }catch (Exception $exception){
            throw new Exception($exception);
        }
    }

    /**
     * @param int $taskAssignToId
     * @return Object
     * @throws Exception
     */
    public function getById(int $taskAssignToId)
    {
        return DB::table('task_assign_tos')
            ->join('users', 'task_assign_tos.team_member_id', '=', 'users.id')
            ->where('task_assign_tos.id', $taskAssignToId)
            ->select('users.name', 'users.photo', 'task_assign_tos.*',
                DB::raw('(SELECT SUM(task_time_trackers.working_hour) FROM task_time_trackers WHERE task_time_trackers.assigned_id = task_assign_tos.id) as working_hour')
            )
            ->first();
    }

    public function store(array $validated, $task_id)
    {
       return DB::table('task_assign_tos')->insertGetId([
            'task_id' => $task_id,
           'team_member_id' => $validated['team_member_id'],
           'assigned_hour' => $validated['assigned_hour'],
           'assigned_by' => Helpers::getUserId(),
           'assigned_time' => date('Y-m-d H:i:s'),
           'assigned_note' => $validated['assigned_note']
        ]);
    }

    /**
     * @param array $validated
     * @param $assign_to_id
     * @return int
     */
    public function update(array $validated, $assign_to_id)
    {
        $query = DB::table('task_assign_tos')->where('id', '=', $assign_to_id);
        if ($query->count()){
            return $query->update($validated);
        }
        return 0;
    }


    /**
     * @param int $assign_to_id
     * @return int
     */
    public function delete(int $assign_to_id)
    {
        $query = DB::table('task_assign_tos')->where('id', '=', $assign_to_id);
        if ($query->count()){
            return $query->delete();
        }
        return 0;
    }

    public function get($task_id, $assignee_id)
    {
        return DB::table('task_assign_tos')
            ->leftJoin('users', 'task_assign_tos.team_member_id', '=', 'users.id')
            ->where('task_assign_tos.task_id', $task_id)
            ->where('users.id', $assignee_id)
            ->select('task_assign_tos.id', 'users.name', 'users.photo')
            ->first();
    }

    public function exists($task_id, $team_member_id): bool
    {
        return DB::table('task_assign_tos')
            ->where('team_member_id', $team_member_id)
            ->where('task_id', $task_id)
            ->exists();

    }
}

<?php

namespace App\Data\Repositories\Projects;

use App\Data\IRepositories\Projects\IProjectActivityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectActivityRepository implements IProjectActivityRepository
{
    /**
     * Get services by project
     *
     * @param int $recordPerPage
     * @param int $project_id
     * @return LengthAwarePaginator
     */
    public function gets(int $recordPerPage, int $project_id, $user_id = 0): LengthAwarePaginator
    {
        $query = DB::table('project_activities')
            ->join('users', 'project_activities.created_by', '=', 'users.id')
            ->leftJoin('employees', 'project_activities.created_by', '=', 'employees.user_id')
            ->where('project_activities.project_id', '=', $project_id)
            ->orderByDesc('project_activities.id')
            ->select('project_activities.*', 'users.name as created_user_name', 'users.photo', 'employees.designation');

        $employee_id = request()->input('employee_id');
        $activity = request()->input('activity');

        if(!empty($employee_id))
            $query->where('project_activities.created_by', $employee_id);
        if(!empty($activity))
            $query->where('project_activities.activity', 'LIKE', "%$activity%");
        if ($user_id)
            $query->where('employees.user_id', '=', $user_id);

        return $query->paginate($recordPerPage);
    }
    /**
     * Get services by user
     *
     * @param int $user_id
     * @return LengthAwarePaginator
     */
    public function getsByUser($user_id, $recordPerPage): LengthAwarePaginator
    {
        $query = DB::table('project_activities')
            ->join('users', 'project_activities.created_by', '=', 'users.id')
            ->join('projects', 'projects.id', '=', 'project_activities.project_id')
            ->join('tasks', 'tasks.id', '=', 'project_activities.task_id')
            ->leftJoin('employees', 'project_activities.created_by', '=', 'employees.user_id')
            ->orderByDesc('project_activities.id')
            ->select('project_activities.*', 'projects.project_name as project_name', 'users.name as created_user_name', 'users.photo', 'employees.designation', 'tasks.task_name as task_name')
            ->where('employees.user_id', '=', $user_id);
        return $query->paginate($recordPerPage);
    }

    public function insert($project_id, $content, $task_id = null)
    {
        DB::table('project_activities')->insert([
            'project_id' => $project_id,
            'task_id' => $task_id,
            'created_by' => Auth::id(),
            'activity' => $content,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getsByTask(int $project_id, int $task_id){
        return DB::table('project_activities')
        ->join('users', 'project_activities.created_by', '=', 'users.id')
        ->leftJoin('employees', 'project_activities.created_by', '=', 'employees.user_id')
        ->where('project_activities.project_id', '=', $project_id)
        ->where('project_activities.task_id', '=', $task_id)
        ->orderByDesc('project_activities.id')
        ->select('project_activities.*', 'users.name as created_user_name', 'users.photo', 'employees.designation')
        ->get();
    }

}

<?php

namespace App\Utility;
use App\Constants\ProjectStatus;
use App\Constants\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectTaskHelper
{

    public static function tasksByDepartmentId($departmentId, $taskStatus = 0, $projectId = 0, $conntType = 0)
    {
        $query = DB::table('tasks')
            ->join('project_purchase_services', 'project_purchase_services.id', '=', 'tasks.service_id')
            ->join('department_services', 'department_services.id', '=', 'project_purchase_services.service_id')
            ->join('departments', 'departments.id', '=', 'department_services.department_id')
            ->where('departments.id', '=', $departmentId)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        return self::extractedFilterOption($taskStatus, $query, $projectId, $conntType);
    }
    public static function tasksByEmolpyeeId($employee_id, $taskStatus = 0, $conntType = 0, $project_id = 0)
    {
        $query = DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=','task_assign_tos.team_member_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('task_assign_tos.team_member_id', '=', $employee_id)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($taskStatus !== 0) {
            $query->where('tasks.status', '=', $taskStatus);
        }
        if ($project_id !== 0)
            $query->where('tasks.project_id', '=', $project_id);

        if ($conntType === 'hour' && $taskStatus === TaskStatus::COMPlETE) {
            return $query->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')->select('task_time_trackers.working_hour')->sum('working_hour');
        }
        if ($conntType ===1 ){
            return $query->select('tasks.id as id','tasks.project_id as project_id','projects.project_name', 'task_assign_tos.assigned_hour')->get();
        }
        return $query->distinct()->select('tasks.id')->get()->count();
    }
    public static function tasksByDepartmentServiceId($departmentServiceId, $taskStatus = 0, $projectId = 0, $conntType = 0)
    {
        $query = DB::table('tasks')
            ->join('project_purchase_services', 'project_purchase_services.id', '=', 'tasks.service_id')
            ->join('department_services', 'department_services.id', '=', 'project_purchase_services.service_id')
            ->join('departments', 'departments.id', '=', 'department_services.department_id')
            ->where('project_purchase_services.id', '=', $departmentServiceId)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        return self::extractedFilterOption($taskStatus, $query, $projectId, $conntType);
    }

    public static function taskCompleteRatioByDepartmentId($departmentId, $projectId)
    {
        $total = ProjectTaskHelper::tasksByDepartmentId($departmentId, 0, $projectId);
        $complete = ProjectTaskHelper::tasksByDepartmentId($departmentId, TaskStatus::COMPlETE, $projectId);
        return ProjectTaskHelper::getRatioByValue($total, $complete) ?? 0;

    }
    public static function taskCompleteRatioByDepartmentServiceId($departmentServiceId, $projectId)
    {
        $total = ProjectTaskHelper::tasksByDepartmentServiceId($departmentServiceId, 0, $projectId);
        $complete = ProjectTaskHelper::tasksByDepartmentServiceId($departmentServiceId, TaskStatus::COMPlETE, $projectId);
        return ProjectTaskHelper::getRatioByValue($total, $complete) ?? 0;
    }

    public static function teamMemberbyDepartment($departmentId)
    {
        return DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=','task_assign_tos.team_member_id')
            ->join('project_purchase_services', 'project_purchase_services.id', '=', 'tasks.service_id')
            ->join('department_services', 'department_services.id', '=', 'project_purchase_services.service_id')
            ->join('departments', 'departments.id', '=', 'department_services.department_id')
            ->where('departments.id', '=', $departmentId)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->select('users.*')->distinct()->get();
    }
    public static function teamMemberbyDepartmentService($departmentServiceId)
    {
        return DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=','task_assign_tos.team_member_id')
            ->join('project_purchase_services', 'project_purchase_services.id', '=', 'tasks.service_id')
            ->join('department_services', 'department_services.id', '=', 'project_purchase_services.service_id')
            ->join('departments', 'departments.id', '=', 'department_services.department_id')
            ->where('project_purchase_services.id', '=', $departmentServiceId)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->select('users.*')->distinct()->get();
    }
    public static function teamMemberbyTask($taskId)
    {
        return DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=','task_assign_tos.team_member_id')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.id', '=', $taskId)
            ->select('users.*')->distinct()->get();
    }

    public static function tasksByProjectId($projectId, $taskStatus = 0)
    {
        $query = DB::table('tasks')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.project_id', '=', $projectId);
        if ($taskStatus !== 0)
            $query->where('tasks.status', '=', $taskStatus);
        return $query->count();
    }

    public static function tasksHourByProjectId($projectId, $taskStatus = 0)
    {
        $query = DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.project_id', '=', $projectId);
        if ($taskStatus === TaskStatus::COMPlETE) {
            $query->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id');
            $query->where('tasks.status', '=', $taskStatus);
            return $query->select('task_time_trackers.working_hour as working_hour')
                ->get()->sum('working_hour');
        }
        if ($taskStatus !== 0) {
            $query->where('tasks.status', '=', $taskStatus);
        }
        return $query->select('task_assign_tos.assigned_hour as total_hour')
            ->get()->sum('total_hour');
    }

    public static function getTasksByProjectId($project_id, $status = 0, $memberId = 0)
    {
        if ($project_id == 0)
            return 0;
        $query = DB::table('tasks')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('project_team_members', 'project_team_members.project_id', '=', 'projects.id')
            ->where('tasks.project_id', '=', $project_id)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($status)
            $query->where('tasks.status', '=', $status);

        return $query->distinct()->select('tasks.*',)->get();
    }

    public static function getCompletedHourByTaskId ($taskId)
    {
        if ($taskId == 0)
            return 0;
        return DB::table('task_assign_tos')
            ->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')
            ->where('task_assign_tos.task_id', '=', $taskId)
            ->select('task_time_trackers.working_hour as completed_hour')
            ->get()->sum('completed_hour');
    }
    public static function getTotalHourByTaskId ($taskId)
    {
        if ($taskId == 0)
            return 0;
        return DB::table('task_assign_tos')
            ->where('task_assign_tos.task_id', '=', $taskId)
            ->select('task_assign_tos.assigned_hour as total_hour')
            ->get()->sum('total_hour');
    }

    public static function getTaskCompleteRatioByTaskId($taskId)
    {
        if ($taskId == 0)
            return 0;
        if (Self::getTotalHourByTaskId($taskId))
            return round((Self::getCompletedHourByTaskId($taskId) / Self::getTotalHourByTaskId($taskId)) * 100, 2, PHP_ROUND_HALF_DOWN);
        return 0;
    }

    public static function getCompleteTaskByUser($userId = 0, $projectId = 0, $countType = '')
    {
        $query = DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=', 'task_assign_tos.team_member_id');
        if ($userId)
            $query->where('users.id', '=', $userId);
        if ($projectId)
            $query->where('tasks.project_id', '=' ,$projectId);

        if ($countType == 'hour')
            return $query->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')
                ->select('task_time_trackers.working_hour')->sum('working_hour');

        return $query->where('tasks.status', '=', TaskStatus::COMPlETE)
            ->select('task_assign_tos.*','tasks.status')->get()->count();
    }

    public static function getTotalTaskByUser($userId = 0, $projectId = 0, $countType = '')
    {
        $query = DB::table('task_assign_tos')
            ->join('tasks', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=', 'task_assign_tos.team_member_id')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
//            ->where('tasks.status', '!=', TaskStatus::COMPlETE)
            ->select('task_assign_tos.*','tasks.status','task_assign_tos.assigned_hour as total_hour');
        if ($userId)
            $query->where('users.id', '=', $userId);
        if ($projectId)
            $query->where('tasks.project_id', '=' ,$projectId);
        if ($countType == 'hour')
            return $query->get()->sum('total_hour');
        return $query->get()->count();
    }
    public static function getTaskCompleteRatioByUser($userId, $projectId = 0)
    {
        if (Self::getTotalTaskByUser($userId, $projectId))
            return round((Self::getCompleteTaskByUser($userId, $projectId, 'hour') / Self::getTotalTaskByUser($userId, $projectId, 'hour')) * 100, 2, PHP_ROUND_HALF_DOWN);
        return 0;
    }
    public static function getTaskCompleteTasksRatioByUser($userId, $projectId = 0)
    {
        if (Self::getTotalTaskByUser($userId, $projectId))
            return round((Self::getCompleteTaskByUser($userId, $projectId) / Self::getTotalTaskByUser($userId, $projectId)) * 100, 2, PHP_ROUND_HALF_DOWN);
        return 0;
    }

    public static function getProjectCount($user_id, $project_status = 0 ){
        $query = DB::table('projects')
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('employees', 'employees.id', '=', 'project_team_members.employee_id')
            ->where('employees.user_id', '=', $user_id)
            ->where('projects.status', '!=', ProjectStatus::CANCELED);
        if ($project_status)
            $query->where('projects.status', '=', $project_status);
        return $query->get()->count();
    }
    public static function getProjects($user_id, $project_status = 0 ){
        $query = DB::table('projects')
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('employees', 'employees.id', '=', 'project_team_members.employee_id')
            ->where('employees.user_id', '=', $user_id)
            ->where('projects.status', '!=', ProjectStatus::CANCELED);
        if ($project_status !==0)
            $query->where('projects.status', '=', $project_status);
        return $query->select('projects.*')->get();
    }

    public static function getCompletedTasksByDepartmentId($departmentId, $taskStatus = 0)
    {
        $query = DB::table('tasks')
            ->join('project_purchase_services', 'tasks.service_id', '=','project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('departments.id', '=', $departmentId);
        if($taskStatus)
            $query->where('tasks.status', '=', $taskStatus);
        else
            $query->where('tasks.status', '!=',TaskStatus::COMPlETE);
        return $query->get()->count();
    }

    public static function getRatioByValue($total,$complete)
    {
        if($total !=0)
            return round($complete / $total * 100, 2, PHP_ROUND_HALF_DOWN);
        return 0;
    }

    /**
     * @param $taskStatus
     * @param \Illuminate\Database\Query\Builder $query
     * @param $projectId
     * @param $conntType
     * @return int|mixed
     */
    private static function extractedFilterOption($taskStatus, \Illuminate\Database\Query\Builder $query, $projectId, $conntType)
    {
        if ($taskStatus !== 0) {
            $query->where('tasks.status', '=', $taskStatus);
        }
        if ($projectId !== 0)
            $query->where('tasks.project_id', '=', $projectId);

        if ($conntType === 'hour' && $taskStatus === TaskStatus::COMPlETE) {
            return $query->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')->select('task_time_trackers.working_hour')->sum('working_hour');
        }
        return $query->distinct()->select('tasks.id')->get()->count();
    }

}

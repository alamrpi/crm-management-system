<?php

namespace App\Data\Repositories\Projects\Task;

use App\Constants\ProjectStatus;
use App\Constants\Task\AcceptedStatus;
use App\Constants\Task\ListViewType;
use App\Constants\TaskStatus;
use App\Constants\TaskType;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Utility\Generator;
use App\Utility\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements ITaskRepository
{
    public function changeDetailLabel($id, $task_id, $label_name)
    {
        DB::table('tasks')->where('id', '=', $task_id)->where('project_id', '=', $id)->update([
            'details_field_name' => $label_name
        ]);
    }

    public function store(array $model, $id): int
    {
        $id = DB::table('tasks')->insertGetId([
            'project_id' => $id,
            'service_id' => $model['service_id'],
            'task_name' => $model['task_name'],
            'task_id' => Generator::taskId($id),
            'due_date' => $model['due_date'],
            'priority' => $model['priority'],
            'task_type' => $model['main_task_id'] == 0 ? TaskType::MAIN : TaskType::SUB,
            'created_by' => Helpers::getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if($model['main_task_id'] != 0){
            DB::table('sub_tasks')->insert([
                'main_task_id' => $model['main_task_id'],
                'sub_task_id' => $id
            ]);
        }

        return $id;
    }

    private function getQuery($id){
        return DB::table('tasks')
        ->join('project_purchase_services', 'tasks.service_id', '=','project_purchase_services.id')
        ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
        ->join('departments', 'department_services.department_id', '=','departments.id')
        ->where('tasks.project_id', $id)
        ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
    }
    public function gets(int $id, int $type = null, int $mainTaskId = 0, $status = 0, $user_id = null): Collection
    {
        $view_type = request()->input('v');

        $query = $this->getQuery($id);

        if($user_id != null){
            $query->join('task_assign_tos', 'tasks.id', '=', 'task_assign_tos.task_id')
              ->where('task_assign_tos.team_member_id', '=', $user_id);
        }

        if($type === TaskType::SUB){
            $query->leftJoin('sub_tasks', 'tasks.id', '=', 'sub_tasks.sub_task_id')
                ->where('sub_tasks.main_task_id', '=',$mainTaskId)
                ->where('tasks.task_type', '=',$type);
        }
        if ($status!=0 && $status == TaskStatus::COMPlETE)
            $query->where('tasks.status', '=', TaskStatus::COMPlETE);

        if ($status === TaskStatus::IN_PROGRESS)
            $query->where('tasks.status', '=', TaskStatus::IN_PROGRESS);

        if ($status!=0 && $status != TaskStatus::COMPlETE)
            $query->where('tasks.status', '!=', TaskStatus::COMPlETE);

        if ($status!=0 && $status == 'INCOMPLETE')
            $query->where('tasks.status', '!=', TaskStatus::COMPlETE);

        if(($view_type == ListViewType::LIST) && ($type !== TaskType::SUB))
            $query->where('tasks.task_type', TaskType::MAIN);

        if($type === TaskType::MAIN){
            $task_name  = request()->input('task_name');
            $task_status  = request()->input('task_status');
            $priority  = request()->input('priority');
            $assign_member_id  = request()->input('assign_member_id');
            $more  = request()->input('more');

            if(!empty($task_name))
                $query->where('tasks.task_name', 'LIK', "%$task_name%");

            if(!empty($task_status))
                $query->where('tasks.status', '=', $task_status);

            if(!empty($priority))
                $query->where('tasks.priority', '=', $priority);

            if(!empty($assign_member_id))
            {
                $query->join('task_assign_tos', 'tasks.id', '=', 'task_assign_tos.task_id')
                    ->where('task_assign_tos.team_member_id', '=', $assign_member_id);
            }

            if(!empty($more))
            {
                if($more == 1){
                    $query->whereDate('tasks.due_date', '<', date('Y-m-d'));
                }else{
                    $query->whereRaw('(SELECT COUNT(*) FROM task_revisions WHERE task_revisions.task_id = tasks.id) > 0');
                }
            }
        }

        return $query
            ->distinct()
            ->select('tasks.*', 'department_services.service_name', 'departments.name as department_name', 'departments.icon as department_photo', 'departments.id as department_id')
            ->orderBy('tasks.status')
            ->get();
    }

    public function getsForClient(int $id, $department_id)
    {
        $query = $this->getQuery($id);


        if(!empty($department_id)){
            $query->where('project_purchase_services.dept_id', $department_id);
        }

        return $query
        ->where('tasks.task_type', TaskType::MAIN)
        ->select('tasks.id', 'tasks.status', 'tasks.task_name', 'tasks.description')
        ->orderBy('tasks.status')
        ->distinct()
        ->get();
    }


    public function getName(int $task_id){
        $task = DB::table('tasks')
            ->where('id', $task_id)
            ->first();

        return $task ?? $task->task_name;
    }
    public function exists($task_id): bool
    {
        return DB::table('tasks')
            ->where('id', $task_id)
            ->exists();
    }
    public function getDepartmentIdById($task_id)
    {
        return DB::table('tasks')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->where('tasks.id', $task_id)
            ->select('project_purchase_services.dept_id')
            ->first()->dept_id;
    }
    /**
     * @param array $validated
     * @param int $task_id
     * @return void
     */
    public function changeStatus(array $validated, int $task_id)
    {
        DB::table('tasks')->where('id', $task_id)->update([
            'status' => $validated['status']
        ]);

        if($validated['status'] == TaskStatus::COMPlETE){
            DB::table('tasks')->where('id', $task_id)->update([
                'status' => $validated['status'],
                'completed_time' => date('Y-m-d H:i:s')
            ]);
        }else{
            DB::table('tasks')->where('id', $task_id)->update([
                'status' => $validated['status']
            ]);
        }
    }

    public function approved($task_id, $id){
        DB::table('tasks')->where('id', $task_id)->update([
            'approved_time' => date('Y-m-d H:i:s')
        ]);
    }

    public function changeAcceptanceStatus($task_id, $status)
    {
        $updatedInfo = [
            'completed_status'=> $status
        ];

        if($status == AcceptedStatus::REVISION)
        {
            DB::table('task_return_revise_records')->insert([
                'task_id' => $task_id,
                'returned_by' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if($status == AcceptedStatus::SUBMIT)
        {
            DB::table('task_submit_records')->insert([
                'task_id' => $task_id,
                'submitted_by' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if($status == AcceptedStatus::ACCEPT){
            $updatedInfo['accepted_time'] = date('Y-m-d H:i:s');
        }

        DB::table('tasks')->where('id', $task_id)->update($updatedInfo);
    }

    public function convertTask(array $validated, int $task_id)
    {
        if($validated['task_type'] == TaskType::MAIN)
            DB::table('sub_tasks')->where('sub_task_id', $task_id)->delete();
        else
            DB::table('sub_tasks')->insert([
                'main_task_id' => $validated['main_task_id'],
                'sub_task_id' => $task_id
            ]);

        DB::table('tasks')->where('id', $task_id)->update([
            'task_type' => $validated['task_type']
        ]);
    }
    /**
     * Get main tasks for convert sub task
     *
     * @param $task_id
     * @return Collection
     */
    public function getMainTasks($task_id, $project_id): Collection
    {
        return DB::table('tasks')
            ->where('task_type', TaskType::MAIN)
            ->whereDate('due_date', '>', date('Y-m-d'))
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.id', '<>', $task_id)
            ->where('tasks.project_id', '=', $project_id)
            ->select('id', 'task_name')
            ->get();
    }
    public function haveAnySubTask(int $task_id): bool
    {
        return DB::table('sub_tasks')
            ->where('main_task_id', $task_id)
            ->exists();
    }
    public function get($task_id, $project_id)
    {
        return DB::table('tasks')
            ->join('project_purchase_services', 'tasks.service_id', '=','project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'project_purchase_services.dept_id', '=','departments.id')
            ->join('projects', 'tasks.project_id', '=','projects.id')
            ->where('tasks.id', $task_id)
            ->where('tasks.project_id', $project_id)
            ->select('tasks.*', 'departments.name as department_name', 'projects.project_name', 'project_purchase_services.dept_id', 'department_services.service_name')
            ->first();
    }

    public function getTrackerActiveTask($user_id)
    {
        return DB::table('tasks')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')
            ->where('task_assign_tos.team_member_id', $user_id)
            ->whereNull('working_hour')
            ->select('tasks.id as task_id', 'tasks.task_name as task_name', 'projects.id as project_id', 'projects.project_name as project_name')
            ->first();
    }
    public function updateInfo(array $data, int $task_id)
    {
        DB::table('tasks')->where('id', $task_id)->update($data);
    }

    public function update($model, $id, $task_id)
    {
        DB::table('tasks')
            ->where('id', $task_id)
            ->where('project_id', $id)
            ->update([
                'service_id' => $model['service_id'],
                'task_name' => $model['task_name'],
                'due_date' => $model['due_date'],
                'priority' => $model['priority'],
                'created_by' => Helpers::getUserId(),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }
    public function getSubtasks($task_id): Collection
    {
        return DB::table('tasks')
            ->join('sub_tasks', 'tasks.id', '=', 'sub_tasks.sub_task_id')
            ->where('task_type', TaskType::SUB)
            ->where('sub_tasks.main_task_id', $task_id)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->select('tasks.*')
            ->get();
    }
    public function getTodayDueTasks($recordPerPage = null, $project_id=0)
    {
        $project_id = $project_id ? request()->input('project_id') ?? 0 : 0;
        $uid = request()->input('uid');
        $clientId = request()->input('client_id');

        $query = DB::table('tasks')
            ->join('projects', 'tasks.project_id','=','projects.id' )
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->where('tasks.status', '!=',TaskStatus::COMPlETE)
            ->whereDate('tasks.due_date', '=', Carbon::today('Asia/Dhaka'))
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($clientId)
            return $this->extractedClient($project_id, $query, $clientId, $recordPerPage);

        return $this->extractedAdmin($project_id, $query, $uid, $recordPerPage);
    }

    public function getRevisionTask($project_ids){
        return DB::table('tasks')
        ->join('projects', 'tasks.project_id','=','projects.id' )
        ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
        ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
        ->join('departments', 'project_purchase_services.dept_id', '=','departments.id')
        ->where('tasks.completed_status', AcceptedStatus::REVISION)
        ->whereIn('tasks.project_id', $project_ids)
        ->select('tasks.id','tasks.task_id', 'tasks.task_name','tasks.completed_time', 'tasks.approved_time', 'tasks.review_time', 'projects.project_name', 'departments.name as dept_name', 'department_services.service_name',
        DB::raw('(SELECT task_submit_records.created_at FROM task_submit_records WHERE task_submit_records.task_id = tasks.id ORDER BY task_submit_records.id DESC LIMIT 1) as submitted_date'),
        DB::raw('(SELECT task_return_revise_records.created_at FROM task_return_revise_records WHERE task_return_revise_records.task_id = tasks.id ORDER BY task_return_revise_records.id DESC LIMIT 1) as return_revision_date')
        )
        ->get();
    }

    public function getLastCompletedTasks($recordPerPage = null, $projectId = null)
    {
        $project_id = $projectId ? request()->input('project_id') ?? 0 : 0;
        $uid = request()->input('uid');
        $clientId = request()->input('client_id');

        $query = DB::table('tasks')
            ->join('projects', 'tasks.project_id','=','projects.id' )
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->where('tasks.status', '=',TaskStatus::COMPlETE)
            ->whereDate('tasks.due_date', '<', Carbon::today())
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($project_id)
            $query->where('tasks.project_id', '=', $project_id);
        $query->orderBy('tasks.due_date', 'desc')
            ->orderBy('id', 'asc')
            ->distinct('tasks.id')
            ->select('tasks.*', 'projects.project_name as project_name', 'departments.name as department_name', 'department_services.service_name as service_name');
        if ($recordPerPage)
            return $query->paginate($recordPerPage);
        return $query->get();
    }
    public function getOverDueTasks($recordPerPage = null , $project_id = null)
    {
        $project_id = $project_id ? request()->input('project_id') ?? 0 : 0;
        $uid = request()->input('uid');
        $clientId = request()->input('client_id');

        $query = DB::table('tasks')
            ->join('projects', 'tasks.project_id','=','projects.id' )
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->where('tasks.status', '!=',TaskStatus::COMPlETE)
            ->whereDate('tasks.due_date', '<', Carbon::today())
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($clientId)
            return $this->extractedClient($project_id, $query, $clientId, $recordPerPage);

        return $this->extractedAdmin($project_id, $query, $uid, $recordPerPage);
    }
    public function getNextDueTasks($recordPerPage = null,  $projectId = null)
    {
        $project_id = $projectId ? request()->input('project_id') ?? 0 : 0;
        $uid = request()->input('uid');
        $clientId = request()->input('client_id');

        $query = DB::table('tasks')
            ->join('projects', 'tasks.project_id','=','projects.id' )
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->where('tasks.status', '!=',TaskStatus::COMPlETE)
            ->whereDate('tasks.due_date', '>=', Carbon::today())
            ->whereDate('tasks.due_date', '<=', Carbon::today()->addDays(3)->format('Y-m-d'))
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($clientId)
            return $this->extractedClient($project_id, $query, $clientId, $recordPerPage);

        return $this->extractedAdmin($project_id, $query, $uid, $recordPerPage);
    }
    public function getCompletedHourByTaskId($taskId)
    {
        return DB::table('task_assign_tos')
            ->join('task_time_trackers', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')
            ->where('task_assign_tos.task_id', '=', $taskId)
            ->select('task_time_trackers.working_hour as completed_hour')
            ->get()->sum('completed_hour');
    }
    public function getTotalHourByTaskId($taskId)
    {
        return DB::table('task_assign_tos')
            ->where('task_assign_tos.task_id', '=', $taskId)
            ->select('task_assign_tos.assigned_hour as total_hour')
            ->get()->sum('total_hour');
    }
    public function getTodayTotalHourByUserId(int $user_id)
    {
        return DB::table('task_time_trackers')
            ->join('task_assign_tos', 'task_time_trackers.assigned_id', '=', 'task_assign_tos.id')
            ->where('task_assign_tos.team_member_id', '=', $user_id)
            ->whereDate('task_time_trackers.created_at', '=', Carbon::today())
            ->select('task_time_trackers.working_hour as total_hour')
            ->get()->sum('total_hour');
    }


    public function getTasksByProjectId($project_id, $status = 0): Collection
    {
        $query = DB::table('tasks')
            ->where('tasks.project_id', '=', $project_id);
        if ($status)
            $query->where('tasks.status', '=', $status);
        return $query->get();
    }
    public function getMultiTaskTimes($taskCollection)
    {
        foreach ($taskCollection as $task){
            $task->total_hour = $this->getTotalHourByTaskId($task->id);
            $task->completed_hour = $this->getCompletedHourByTaskId($task->id);
        }
        return $taskCollection;
    }

    public function getTaskByMonthWithStatus($projectId, $status = 0, $month): Collection
    {

        $uid = request()->input('uid');
        $query = DB::table('tasks')
            ->join('projects', 'tasks.project_id','=','projects.id' )
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('project_purchase_services', 'tasks.service_id', '=', 'project_purchase_services.id')
            ->join('department_services', 'project_purchase_services.service_id', '=','department_services.id')
            ->join('departments', 'department_services.department_id', '=','departments.id')
            ->whereDate('tasks.due_date', 'like', $month.'%')
            ->where('projects.id', '=', $projectId)
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0');
        if ($status === TaskStatus::COMPlETE)
            $query->where('tasks.status', '=',$status);
        else
            $query->where('tasks.status', '!=',TaskStatus::COMPlETE);
        if ($uid)
            $query->where('project_team_members.employee_id', '=', $uid);
        return $query
            ->distinct()
            ->select('tasks.*')
            ->get();
    }

    /**
     * @param $project_id
     * @param \Illuminate\Database\Query\Builder $query
     * @param $uid
     * @param $recordPerPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function extractedAdmin($project_id, \Illuminate\Database\Query\Builder $query, $uid, $recordPerPage)
    {
        if ($project_id !== 0)
            $query->where('projects.id', '=', $project_id);
        if ($uid !==0 )
            $query->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
                ->where('task_assign_tos.team_member_id', '=', $uid);

        $query->orderBy('tasks.due_date', 'desc')
            ->orderBy('id', 'asc')
            ->distinct('tasks.id')
            ->select('tasks.*', 'projects.project_name as project_name', 'departments.name as department_name', 'department_services.service_name as service_name');
        if ($recordPerPage)
            return $query->paginate($recordPerPage);
        return $query->get();
    }

    /**
     * @param $project_id
     * @param \Illuminate\Database\Query\Builder $query
     * @param $uid
     * @param $recordPerPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function extractedClient($project_id, \Illuminate\Database\Query\Builder $query, $clientId, $recordPerPage)
    {
        if ($project_id !== 0)
            $query->where('projects.id', '=', $project_id);
        if ($clientId !== 0)
            $query->where('projects.client_id', '=', $clientId);

        $query->orderBy('tasks.due_date', 'desc')
            ->orderBy('id', 'asc')
            ->distinct('tasks.id')
            ->select('tasks.*', 'projects.project_name as project_name', 'departments.name as department_name', 'department_services.service_name as service_name');
        if ($recordPerPage)
            return $query->paginate($recordPerPage);
        return $query->get();
    }

    public function getCompleteTask($userId = 0, $projectId = 0, $countType = '')
    {
        $query = DB::table('task_assign_tos')
            ->join('tasks', 'task_assign_tos.task_id', '=', 'tasks.id')
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

    public function getTotalTask($userId = 0, $projectId = 0, $countType = '')
    {
        $query = DB::table('tasks')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.status', '!=', TaskStatus::COMPlETE)
            ->select('task_assign_tos.*','tasks.status','task_assign_tos.assigned_hour as total_hour');
        if ($userId || $countType == 'hour')
            $query->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
                ->join('users', 'users.id', '=', 'task_assign_tos.team_member_id');
        if ($userId)
            $query->where('users.id', '=', $userId);
        if ($projectId)
            $query->where('tasks.project_id', '=' ,$projectId);
        if ($countType == 'hour')
            return $query->get()->sum('total_hour');
        return $query->get()->count();
    }
    public function nextDayTasksByUserId(int $userId){
        return DB::table('tasks')
            ->join('task_assign_tos', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('users', 'users.id', '=', 'task_assign_tos.team_member_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->whereRaw('(SELECT COUNT(*) FROM task_archives WHERE task_archives.task_id = tasks.id) = 0')
            ->where('tasks.status', '!=', TaskStatus::COMPlETE)
            ->whereDate('due_date', '=', Carbon::tomorrow('Asia/Dhaka')->format('Y-m-d'))
            ->where('users.id', '=', $userId)
            ->select('tasks.*','projects.project_name  as project_name','task_assign_tos.assigned_hour as total_hour')
            ->get();
    }

    /**
     * @param int $projectId
     * @param $date
     * @param $status
     * @return Collection
     */
    public function tasksByDate(int $projectId, $date, $status): Collection
    {
        return DB::table('tasks')
            ->where('project_id', '=', $projectId)
            ->whereDate('due_date', '=', $date)
            ->where('status', $status)
            ->get();
    }
}

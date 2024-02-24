<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskTimeTrackerRepository;
use App\Utility\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskTimeTrackerRepository implements ITaskTimeTrackerRepository
{
    public function store($time, $task_id): int
    {
       return DB::table('task_archives')->insertGetId([
           'task_id' => $task_id,
           'archiving_by' => Helpers::getUserId(),
           'archived_time' => date('Y-m-d H:i:s'),
        ]);
    }

    public function startTime($startedTime, int $assignee_id)
    {
        DB::table('task_time_trackers')->insertGetId([
            'assigned_id' => $assignee_id,
            'start_time' => $startedTime,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getStartedTime(int $assignee_id)
    {
        $tracker =  $this->activeTimer($assignee_id);

        if(!empty($tracker))
            return $tracker->start_time;

        return null;
    }

    public function getStartedTimeByUserId(int $user_id)
    {
        $tracker =  $this->activeTimerByUserId($user_id);

        if(!empty($tracker))
            return $tracker->start_time;

        return null;
    }

    public function stopTimer($endTime, int $assignee_id, $note)
    {
        $tracker =  $this->activeTimer($assignee_id);

        $startDate = Carbon::parse($tracker->start_time);
        $hourDifference = $endTime->diffInMinutes($startDate) / 60;

        DB::table('task_time_trackers')->where('id', $tracker->id)->update([
            'end_time' => $endTime,
            'working_hour' => (string)round($hourDifference, 2),
            'updated_at' => date('Y-m-d H:i:s'),
            'note' => $note
        ]);
    }

    public function activeTimer($assignee_id){
        return DB::table('task_time_trackers')
            ->where('assigned_id', $assignee_id)
            ->whereNull('working_hour')
            ->first();
    }
    public function activeTimerByUserId($userId){
        return DB::table('task_time_trackers')
            ->join('task_assign_tos', 'task_assign_tos.id', '=', 'task_time_trackers.assigned_id')
            ->where('task_assign_tos.team_member_id', $userId)
            ->whereNull('working_hour')
            ->first();
    }

    public function addHour($hour, $assignee_id){
        DB::table('task_time_trackers')->insertGetId([
            'assigned_id' => $assignee_id,
            'working_hour' => implode('.', explode(':', $hour)),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function addManual($fromTime, $endTime, $assignee_id){

        $startDate = Carbon::parse($fromTime);
        $endTime = Carbon::parse($endTime);
        $hourDifference = $endTime->diffInMinutes($startDate) / 60;

        DB::table('task_time_trackers')->insertGetId([
            'assigned_id' => $assignee_id,
            'start_time' => $fromTime,
            'end_time' => $endTime,
            'working_hour' => (string)round($hourDifference, 2),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getByTask($task_id)
    {
        return DB::table('task_time_trackers')
            ->join('task_assign_tos', 'task_time_trackers.assigned_id', '=', 'task_assign_tos.id')
            ->leftJoin('users', 'task_assign_tos.team_member_id', '=', 'users.id')
            ->where('task_assign_tos.task_id', $task_id)
            ->select('task_time_trackers.*', 'users.name as member_name', 'users.photo', 'users.id as user_id')
            ->get();
    }

    public function remove($tracker_id){
        DB::table('task_time_trackers')->where('id', $tracker_id)->delete();
    }

    public function get($tracker_id){
        return  DB::table('task_time_trackers')->where('id', $tracker_id)->first();
    }

    public function update($model)
    {
        if(!empty($model['startTime']) && !empty($model['endTime'])){
            $startDate = Carbon::parse($model['startTime']);
            $endTime = Carbon::parse($model['endTime']);
            $hourDifference = $endTime->diffInMinutes($startDate) / 60;
            $hourDifference = (string)round($hourDifference, 2);
        }else{
            $hourDifference = implode(".", explode(':', $model['working_hour']));
            $startDate = null;
            $endTime = null;
        }

        DB::table('task_time_trackers')->where('id', $model['tracker_id'])->update([
            'start_time' => $startDate,
            'end_time' => $endTime,
            'working_hour' => $hourDifference,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function gets(int $recordPerPage, $userId = null)
    {
        $project_id = request()->input('project_id');
        $member_id = request()->input('member_id');
        $from_date = request()->input('from_date');
        $to_date = request()->input('to_date');

        $query = DB::table('task_time_trackers')
            ->join('task_assign_tos', 'task_time_trackers.assigned_id', '=', 'task_assign_tos.id')
            ->join('tasks', 'task_assign_tos.task_id', '=', 'tasks.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'task_assign_tos.team_member_id', '=', 'users.id');

        if($userId != null){
            $query->where('task_assign_tos.team_member_id', $userId);
        }

        if(!empty($project_id))
            $query->where('tasks.project_id', $project_id);

        if(!empty($member_id))
            $query->where('task_assign_tos.team_member_id', $member_id);

        if(!empty($from_date))
            $query->where('task_time_trackers.created_at', '>=', $from_date);

        if(!empty($to_date))
            $query->where('task_time_trackers.created_at', '<=', $to_date);

        return $query
            ->select('task_time_trackers.*', DB::raw('DATE(task_time_trackers.created_at) as created_date'),'users.name as user_name', 'users.photo', 'tasks.task_name', 'projects.project_name')
            ->orderByDesc('task_time_trackers.created_at')
            ->distinct()
            ->paginate($recordPerPage)->appends([
                'project_id' => $project_id,
                'member_id' => $member_id,
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]);

    }
}

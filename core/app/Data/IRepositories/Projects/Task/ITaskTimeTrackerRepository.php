<?php

namespace App\Data\IRepositories\Projects\Task;

interface ITaskTimeTrackerRepository
{
    public function store($time, $task_id): int;
    public function startTime($startedTime, int $assignee_id);
    public function getStartedTime(int $assignee_id);
    public function getStartedTimeByUserId(int $user_id);
    public function stopTimer($endTime, int $assignee_id, $note);
    public function activeTimer($assignee_id);
    public function activeTimerByUserId($userId);
    public function addHour($hour, $assignee_id);
    public function addManual($fromTime, $endTime, $assignee_id);
    public function getByTask($task_id);
    public function remove($tracker_id);
    public function get($tracker_id);
    public function update($model);
    public function gets(int $recordPerPage, $userId = null);
}

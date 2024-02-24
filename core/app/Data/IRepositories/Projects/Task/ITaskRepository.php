<?php

namespace App\Data\IRepositories\Projects\Task;

use App\Constants\TaskType;
use Illuminate\Support\Collection;

interface ITaskRepository
{
    public function changeDetailLabel($id, $task_id, $label_name);
    public function store(array $model, $id): int;
    public function update($model, $id, $task_id);

    public function gets(int $id, int $type = null, int $mainTaskId = 0, $status = 0, $user_id = null);
    public function getsForClient(int $id, int $department_id);

    public function exists($task_id);

    public function getDepartmentIdById($task_id);

    public function changeStatus(array $validated, int $task_id);
    public function changeAcceptanceStatus($task_id, $status);

    public function convertTask(array $validated, int $task_id);

    public function getMainTasks($task_id, $project_id);

    public function haveAnySubTask(int $task_id);

    public function get($task_id, $project_id);
    public function getTrackerActiveTask($user_id);
    public function getRevisionTask($project_ids);
    public function getName(int $task_id);

    public function updateInfo(array $data, int $task_id);
    public function approved($task_id, $id);

    public function getSubtasks($task_id);
    public function getOverDueTasks();
    public function getNextDueTasks($recordPerPage = null, $projectId = null);
    public function getTodayDueTasks($recordPerPage = null, $project_id=0);
    public function getCompletedHourByTaskId($taskId);
    public function getTotalHourByTaskId($taskId);
    public function getTodayTotalHourByUserId(int $user_id);
    public function getTaskByMonthWithStatus($projectId, $status, $month);
    public function getMultiTaskTimes($taskCollection);
    public function getTasksByProjectId($project_id, $status = 0): Collection;
    public function getLastCompletedTasks($recordPerPage = null, $projectId = null);
    public function getTotalTask($userId = 0, $projectId = 0, $countType = '');
    public function getCompleteTask($userId = 0, $projectId = 0, $countType = '');
    public function nextDayTasksByUserId(int $userId);
    public function tasksByDate(int $projectId, $date, $status): Collection;
}

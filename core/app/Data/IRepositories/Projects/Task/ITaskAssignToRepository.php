<?php

namespace App\Data\IRepositories\Projects\Task;

use Exception;
use Illuminate\Support\Collection;

interface ITaskAssignToRepository
{
    /**
     * @param int $taskId
     * @return Collection
     * @throws Exception
     */
    public function gets(int $taskId): Collection;

    public function getById(int $taskAssignToId);

    public function store(array $validated, $task_id);
    public function update(array $validated, $assign_to_id);
    public function delete(int $assign_to_id);

    public function get($task_id, $assignee_id);

    public function exists($task_id, $team_member_id);
}

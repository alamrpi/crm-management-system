<?php

namespace App\Data\IRepositories\Projects;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface IProjectActivityRepository
{
    /**
     * Get services by project
     *
     * @param int $recordPerPage
     * @param int $project_id
     * @return LengthAwarePaginator
     */
    public function gets(int $recordPerPage, int $project_id): LengthAwarePaginator;
    public function getsByTask(int $project_id, int $task_id);

    public function insert($project_id, $content, $task_id = null);
    public function getsByUser($user_id, $recordPerPage);
}

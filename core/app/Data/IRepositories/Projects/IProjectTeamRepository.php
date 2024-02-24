<?php

namespace App\Data\IRepositories\Projects;

use App\Models\Project\ProjectTeamMember;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IProjectTeamRepository
{
    /**
     * Get services by project
     *
     * @param int $project_id
     * @return Collection
     */
    public function gets(int $project_id): Collection;

    public function getsWithPagination(int $project_id, int $recordPerPage, string $name = null): LengthAwarePaginator;

    public function count($id);

    public function removeMember($access_id);

    /**
     * @return mixed
     */
    public function getForDdl(int $project_id, int $department_id = null);

    public function getAllForDdl();

}

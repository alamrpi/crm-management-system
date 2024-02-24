<?php

namespace App\Data\IRepositories\Auth;

interface IRoleAccessRepository
{
    public function getAssignedAccessIds($roleId): array;

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function store($role_id, $access_ids);

    public function getAccessesByRole($id);
}

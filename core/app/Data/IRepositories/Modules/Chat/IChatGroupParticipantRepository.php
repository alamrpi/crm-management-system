<?php

namespace App\Data\IRepositories\Modules\Chat;

interface IChatGroupParticipantRepository
{
    public function store($model);
    public function getParticipantByGroupId(int $groupId);
}

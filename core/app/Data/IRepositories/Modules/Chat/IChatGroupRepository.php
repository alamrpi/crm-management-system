<?php

namespace App\Data\IRepositories\Modules\Chat;

use Illuminate\Support\Collection;

interface IChatGroupRepository
{
    public function store(array $model);
    public function update(int $id, array $model);
    public function destroy(int $id);

    public function getGroupsByUserId(int $userId);
    public function memberSuggestion($agency_id, $queryType = null,  $userid = null);

    public function getGroupById(int $id);

    public function checkPersonalGroupExist(int $id, int $memberId);
}

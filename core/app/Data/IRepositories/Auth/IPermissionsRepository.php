<?php

namespace App\Data\IRepositories\Auth;

use Illuminate\Support\Collection;

interface IPermissionsRepository
{
    public function gets(): Collection;
    public function getAccessIds($user_id);
    public function permissionSaveChanges($user_id, $access_ids);

    public function activationToggle($user_id, $deactivated);
}

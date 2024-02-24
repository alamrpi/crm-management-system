<?php

namespace App\Data\Repositories\Auth;

use App\Data\IRepositories\Auth\IPermissionsRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PermissionsRepository implements IPermissionsRepository
{
    public function gets(): Collection
    {
        return DB::table('auth_permissions')
            ->orderBy('name')
            ->get();
    }

    public function getAccessIds($user_id)
    {
        return DB::table('auth_permissions')
        ->where('user_id', $user_id)
        ->pluck('access_id')
        ->toArray();
    }

    public function permissionSaveChanges($user_id, $access_ids){
        DB::table('auth_permissions')->where('user_id', $user_id)->delete();

        if(!empty($access_ids)){
            $permissions = [];
            foreach ($access_ids as $access_id){
                $permissions[] = [
                    'access_id' => $access_id,
                    'user_id' => $user_id
                ];
            }

            DB::table('auth_permissions')->insert($permissions);
        }
    }

    public function activationToggle($user_id, $deactivated)
    {
        DB::table('users')->where('id', $user_id)->update([
            'deactivated' => $deactivated == 1 ? 0 : 1
        ]);
    }
}

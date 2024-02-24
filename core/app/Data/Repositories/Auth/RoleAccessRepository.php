<?php

namespace App\Data\Repositories\Auth;

use App\Data\IRepositories\Auth\IRoleAccessRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleAccessRepository implements IRoleAccessRepository
{
    public function getAssignedAccessIds($roleId): array
    {
        return DB::table('auth_role_accesses')
            ->where('role_id', $roleId)
            ->pluck('access_id')
            ->toArray();
    }

    /**
     * @inheritDoc
     */
    public function store($role_id, $access_ids)
    {
        DB::table('auth_role_accesses')->where('role_id', $role_id)->delete();

        $role_accesses = [];
        foreach ($access_ids as $access_id){
            $role_accesses[] = [
                'access_id' => $access_id,
                'role_id' => $role_id
            ];
        }

        DB::table('auth_role_accesses')->insert($role_accesses);
    }

    public function getAccessesByRole($id): Collection
    {
        return DB::table('auth_role_accesses')
            ->join('auth_accesses', 'auth_role_accesses.access_id', '=', 'auth_accesses.id')
            ->where('role_id', $id)
            ->select('auth_role_accesses.*', 'auth_accesses.name as access_name')
            ->get();
    }
}

<?php

namespace App\Data\Repositories\Auth;

use App\Data\IRepositories\Auth\IAccessRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AccessRepository implements IAccessRepository
{
    public function gets(): Collection
    {
        return DB::table('auth_accesses')
            ->orderBy('name')
            ->get();
    }
}

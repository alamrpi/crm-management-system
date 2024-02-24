<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IClientEnrollRepository;
use http\Client;
use Illuminate\Support\Facades\DB;

class ClientEnrollRepository implements IClientEnrollRepository
{
    public function Insert($model)
    {
        DB::table('client_enrolls')->insert([
            'agency_id' => $model['agency_id'],
            'client_id' => $model['client_id'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }


    public function existsByAgencyId($agency_id, $id): bool
    {
        return DB::table('client_enrolls')->where('agency_id', $agency_id)->where('client_id', $id)->exists();
    }
}

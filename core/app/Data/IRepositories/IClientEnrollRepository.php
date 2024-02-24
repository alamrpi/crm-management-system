<?php

namespace App\Data\IRepositories;

interface IClientEnrollRepository
{
    public function Insert($model);

    public function existsByAgencyId($agency_id, $id): bool;
}

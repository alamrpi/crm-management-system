<?php

namespace App\Data\IRepositories\Auth;

use Illuminate\Support\Collection;

interface IAccessRepository
{
    public function gets(): Collection;
}

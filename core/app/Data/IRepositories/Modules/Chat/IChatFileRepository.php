<?php

namespace App\Data\IRepositories\Modules\Chat;

use Illuminate\Support\Collection;

interface IChatFileRepository
{
    public function store(array $model): int;
    public function getChatFiles(int $messageId);
}

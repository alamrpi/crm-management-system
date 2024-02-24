<?php

namespace App\Data\IRepositories\Modules\Chat;

interface IChatRepository
{
    public function store(array $model) : int;
    public function getMessages(int $groupId, int $messageId = null );
    public function getChatHistory(int $userId);
}

<?php

namespace App\Data\Repositories\Modules\Chat;

use App\Data\IRepositories\Modules\Chat\IChatFileRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChatFileRepository implements IChatFileRepository
{
    public function store(array $model): int
    {
        return DB::table('chat_message_files')
        ->insertGetId($model);
    }
    public function getChatFiles(int $messageId): Collection
    {
        return DB::table('chat_message_files')
            ->where('chat_message_id', '=', $messageId)
            ->get();
    }
}

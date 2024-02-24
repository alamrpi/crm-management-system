<?php

namespace App\Data\Repositories\Modules\Chat;

use App\Data\IRepositories\Modules\Chat\IChatRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChatRepository implements IChatRepository
{
    public function store(array $model): int
    {
        return DB::table('chat_messages')
        ->insertGetId($model);
    }
    public function getMessages(int $groupId ,int $messageId = null)
    {
        $query = DB::table('chat_messages')
            ->join('users', 'chat_messages.participant_id', '=', 'users.id');
        if (!is_null($messageId))
            $query->where('chat_messages.id', '=', $messageId);

        $query->where('chat_messages.group_id', '=', $groupId)
            ->select('chat_messages.*','users.photo as user', 'users.name as name', DB::raw('(SELECT COUNT(*) FROM chat_message_files WHERE chat_message_files.chat_message_id = chat_messages.id) as file_count'))
            ->orderByDesc('id');
        return $query->paginate(20);
    }

    public function getChatHistory(int $userId)
    {
        return DB::table('chat_groups')
            ->join('chat_messages', 'chat_groups.id', '=', 'chat_messages.group_id')
            ->where('chat_messages.participant_id', '=', $userId)
            ->select('chat_groups.id as id', 'chat_groups.group_name as group_name', 'chat_groups.photo as photo', 'chat_messages.id as message_id')
            ->orderBy('chat_messages.id',  'desc')
            ->get();
    }
}

<?php

namespace App\Data\Repositories\Modules\Chat;

use App\Data\IRepositories\Modules\Chat\IChatGroupParticipantRepository;
use Illuminate\Support\Facades\DB;

class ChatGroupParticipantRepository implements IChatGroupParticipantRepository
{
    public function store($model)
    {
        DB::table('chat_group_participants')->insert($model);
    }

    public function getParticipantByGroupId(int $groupId)
    {
        return DB::table('chat_group_participants')
            ->join('users', 'chat_group_participants.participant_id', '=', 'users.id')
            ->where('group_id', '=', $groupId)
            ->select('users.id as id', 'users.name as name', 'users.photo as photo')
            ->get();
    }
}

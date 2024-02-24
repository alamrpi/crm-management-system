<?php

namespace App\Data\Repositories\Modules\Chat;

use App\Data\IRepositories\Modules\Chat\IChatGroupRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatGroupRepository implements IChatGroupRepository
{
    public function Store(array $model)
    {
        return DB::table('chat_groups')->insertGetId([
            'group_name'    => $model['group_name'],
            'group_type'    => $model['group_type'],
            'photo'         => $model['photo'],
            'created_by'    => $model['created_by'],
        ]);
    }

    public function update(int $id, array $model)
    {
        echo '';
    }
    public function destroy(int $id)
    {
        echo '';
    }

    public function memberSuggestion($agency_id, $queryType = null, $userId = null)
    {
        $query =  DB::table('users')
            ->WhereIn('id', function($query) use ($agency_id, $queryType, $userId){
                $query->select('user_id')
                    ->from('clients')
                    ->Join('client_enrolls', 'clients.id', '=', 'client_enrolls.client_id')
                    ->where('client_enrolls.agency_id', '=', $agency_id);
                if ($queryType) {
                    $query->join('projects', 'clients.id', '=', 'projects.client_id')
                        ->whereIn('projects.id', function($query) use($userId){
                        $query->select('projects.id')
                            ->from('projects')
                            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
                            ->where('project_team_members.employee_id', '=', function($query) use ($userId){
                                $query->select('id')->from('employees')->where('user_id', '=', $userId);
                            });
                    });
                }
            })
            ->orWhereIn('id', function($query) use ($queryType){
                $query->select('user_id')->from('employees');
                if ($queryType)
                    $query->where('employee_type_id', '>', $queryType );
            })
            ->where('users.agency_id', $agency_id)
            ->orderBy('users.name')
            ->select('users.id', 'users.name', 'users.photo');

        return $query->get();
    }

    public function getGroupsByUserId(int $userId)
    {
        return DB::table('chat_groups')
            ->join('chat_group_participants', 'chat_groups.id', '=', 'chat_group_participants.group_id')
            ->where('chat_groups.group_type', '=', 2)
            ->where('chat_group_participants.participant_id', '=', $userId)
            ->distinct('chat_groups.id')
            ->select('chat_groups.id', 'chat_groups.group_name', 'chat_groups.photo')
            ->get();
    }

    public function getGroupById(int $id)
    {
        return DB::table('chat_groups')
            ->where('id', '=', $id)
            ->first();
    }

    public function checkPersonalGroupExist(int $id, int $memnerId)
    {

        return $this->getQuery()
            ->where('chat_groups.group_type', '=', 1)
            ->where('chat_group_participants.participant_id','=', $id)
            ->whereExists(function($query) use ($memnerId){
                $query->select(DB::raw(1))
                    ->from('chat_group_participants')
                    ->whereColumn('chat_group_participants.group_id', '=', 'chat_groups.id')
                    ->where('chat_group_participants.participant_id','=', $memnerId);
            })
            ->select('chat_groups.id as id');
    }
    private function getQuery(){
        return DB::table('chat_groups')
            ->join('chat_group_participants', 'chat_groups.id', '=', 'chat_group_participants.group_id');
    }
}

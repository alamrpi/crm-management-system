<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IUserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\assertJsonFileEqualsJsonFile;

class UserRepository implements IUserRepository
{
    public function insert($model)
    {
       return DB::table('users')->insertGetId([
            'name' => $model['name'],
            'email' => $model['email'],
            'password' => bcrypt($model['password']),
            'role' => $model['role'],
            'agency_id' => $model['agency_id'],
            'photo' => $model['photo'],
            'approved' => 1,
            'deactivated' => 0
        ]);
    }

    public function update($user_id, array $model, string $role_name = null)
    {
        $data = [
            'name' => $model['name'],
            'email' => $model['email'],
        ];
        if (!empty($model['photo']))
            $data['photo'] = $model['photo'];
        if (!is_null($role_name))
            $data['role'] = $role_name;
        DB::table('users')->where('id', $user_id)->update($data);
    }

    public function delete($user_id)
    {
        DB::table('users')->where('id', $user_id)->delete();
    }

    public function deactive($user_id)
    {
        DB::table('users')->where('id', $user_id)->update([
            'deactivated' => 1
        ]);
    }

    public function getAll()
    {
        return DB::table('users');
    }

    public function getUserById(int $id){
        return DB::table('users')->where('id', $id)->first();
    }

    public function findByEmail($email)
    {
        return DB::table('users')->where('email', $email)->exists();
    }

    /**
     * Update from client enroll
     *
     * @param int $user_id
     * @param int $agency_id
     * @return void
     */
    public function updateAgencyId(int $user_id, int $agency_id)
    {
        DB::table('users')->where('id', $user_id)->update([
            'agency_id' => $agency_id
        ]);
    }

    public function getById($user_id)
    {
        return DB::table('users')->where('id', $user_id)->first();
    }

    public function gets(int $recordPerPage = null)//: LengthAwarePaginator
    {
        $agency_id = Auth::user()->agency_id;
         $query = DB::table('users')
             ->where('users.role', '<>','admin')
             ->where('users.agency_id', $agency_id);

        $name = request()->input('name');
        $email = request()->input('email');

        if(!empty($name))
            $query->where('users.name', 'LIKE', "%$name%");
        if(!empty($email))
            $query->where('users.email', 'LIKE', "%$email%");
        return $recordPerPage === null ? $query
            ->orderByDesc('users.id')
            ->get() : $query
            ->orderByDesc('users.id')
            ->paginate($recordPerPage)
            ->appends([
                'name' => $name
            ]);
    }

    public function getCurrentUser(){
        $user_id = Auth::id();
        return $this->getById($user_id);
    }

    public function getSocialLink($id)
    {
        return DB::table('user_social_links')
            ->join('social_networks', 'user_social_links.social_network_id', '=', 'social_networks.id')
            ->select('user_social_links.*', 'social_networks.name', 'social_networks.icon')
            ->where('user_id', $id)->get();
    }

    public function storeSocialLink($id, array $model)
    {
        DB::table('user_social_links')->insertGetId([
            'user_id' => $id,
            'social_network_id' => $model['media_name'],
            'profile_url' => $model['profile_url'],
            'created_at' => date('Y-m-d')
        ]);
    }

    public function deleteSocialLink($id, $media_id)
    {
        DB::table('user_social_links')->where('user_id', $id)->where('id', $media_id)->delete();
    }

    public function getUserCvs($id)
    {
        return DB::table('user_cvs')->where('user_id', $id)->get();
    }

    public function storeCv($id, array $model)
    {
        DB::table('user_cvs')->insertGetId([
            'user_id' => $id,
            'file_name' => $model['file_name'],
            'file_path' => $model['file_path'],
            'created_at' => date('Y-m-d')
        ]);
    }

    public function deleteCv($id, $cv_id)
    {
        DB::table('user_cvs')->where('user_id', $id)->where('id', $cv_id)->delete();
    }

    public function getSocialNetworks()
    {
        return  DB::table('social_networks')->get();
    }
}

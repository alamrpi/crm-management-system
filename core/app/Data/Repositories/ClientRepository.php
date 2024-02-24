<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IDepartmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientRepository implements IClientRepository
{
    public function findById(int $id)
    {
        return $this->getQuery()
            ->select('clients.*', 'users.name', 'users.email')
            ->where('clients.id', $id)
            ->first();
    }
    public function gets(int $recordPerPage): LengthAwarePaginator
    {
        $query = $this->getQuery()
            ->select('clients.*', 'users.name', 'users.email', 'users.photo');

        $name = request()->input('name');

        if(!empty($name))
            $query->where('users.name', 'LIKE', "%$name%");

        return $query
            ->orderByDesc('clients.id')
            ->paginate($recordPerPage)
            ->appends([
                'name' => $name,
            ]);
    }

    /**
     * Client insert method
     * THis is created from authorize and unauthorized user.
     * Warning!!
     * So can't retrieve agency id from current user.
     *
     * @param array $model
     * @return int
     */
    public function insert(array $model): int
    {
        return DB::table('clients')->insertGetId([
            'client_id' => $model['client_id'],
            'user_id' => $model['user_id'],
            'address' => $model['address'],
            'company_name' => $model['company_name'],
            'website' => $model['website'],
            'logo' => $model['logo'],
            'created_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @param array $model
     * @return void
     */
    public function update(int $id, array $model)
    {
        $this->getQuery()
            ->where('clients.id', $id)
            ->update([
                'address' => $model['address'],
                'company_name' => $model['company_name'],
                'website' => $model['website'],
                'logo' => $model['logo'],
                'clients.updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id){
        $this->getQuery()
            ->where('clients.id',$id)
            ->delete();
    }

    /**
     * @param string $email
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     */
    public function findByEmail(string $email, int $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('clients.id', '!=', $id);

        return $query->where('users.email', 'LIKE', "%$email%")->first();
    }

    private function getQuery(): Builder
    {
        $agency_id = Auth::user()->agency_id;
        return DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('client_enrolls', 'clients.id', '=', 'client_enrolls.client_id')
            ->where('client_enrolls.agency_id', $agency_id);
    }

    public function getAll()
    {
        return $this->getQuery()->orderBy('users.name')->select('clients.id','users.name')->get();
    }

    public function getClientId($client_id)
    {
        return $this->getQuery()
            ->where('clients.client_id', '=', $client_id)
            ->select('clients.id', 'clients.address','clients.company_name', 'users.photo', 'users.name', 'users.email')
            ->first();
    }

    public function getByUserId($user_id)
    {
        return $this->getQuery()
            ->where('users.id', '=', $user_id)
            ->select('clients.id', 'clients.address','clients.company_name', 'users.photo', 'users.name', 'users.email')
            ->first();
    }

}

<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IRoleRepository;
use App\Utility\Helpers;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleRepository implements IRoleRepository
{
    public function findById(int $id)
    {
        return $this->getQuery()->where('id', $id)->first();
    }
    public function gets(int $recordPerPage): LengthAwarePaginator
    {
        $query = $this->getQuery();

        $name = request()->input('role_name');

        if(!empty($name))
            $query->where('roles.role_name', 'LIKE', "%$name%");

        return $query->select('roles.*')
            ->orderByDesc('id')
            ->paginate($recordPerPage)
            ->appends([
                'role_name' => $name
            ]);
    }

    public function insert(array $model): int
    {
        return  $this->getQuery()->insertGetId([
            'agency_id' => Helpers::GetAgencyId(),
            'role_name' => $model['role_name'],
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
        $this->getQuery()->where('id', $id)->update([
            'role_name' => $model['role_name'],
            'updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id){
        $this->getQuery()->where('id', $id)->delete();
    }

    public function existsInEmployee($id)
    {
        return DB::table('employees')->where('employee_type_id', $id)->exists();
    }
    /**
     * @param string $name
     * @param int|null $id ignore id
     */
    public function findByName(string $name, int $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('id', '!=', $id);

        return $query->where('role_name', 'LIKE', $name)->first();
    }

    private function getQuery(): Builder
    {
        return DB::table('roles')
            ->where('roles.agency_id', Helpers::GetAgencyId());
    }

    public function getAll()
    {
        return $this->getQuery()
            ->orderBy('role_name')
            ->select('id','role_name')
            ->get();
    }
}

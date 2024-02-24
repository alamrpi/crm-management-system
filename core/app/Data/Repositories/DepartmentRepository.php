<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IDepartmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentRepository implements IDepartmentRepository
{
    public function findById(int $id)
    {
        return $this->getQuery()
            ->join('agencies', 'departments.agency_id', '=', 'agencies.id')
            ->select('departments.*', 'agencies.name as agency_name')
            ->where('departments.id', $id)
            ->first();
    }
    public function gets(int $recordPerPage): LengthAwarePaginator
    {
        $query = $this->getQuery()
            ->join('agencies', 'departments.agency_id', '=', 'agencies.id')
            ->select('departments.*', 'agencies.name as agency_name');

        $name = request()->input('name');

        if(!empty($name))
            $query->where('departments.name', 'LIKE', "%$name%");

        return $query
            ->orderByDesc('id')
            ->paginate($recordPerPage)
            ->appends([
                'name' => $name
            ]);
    }

    public function insert(array $model): int
    {
        return  $this->getQuery()->insertGetId([
            'name' => $model['name'],
            'icon' => $model['icon'],
            'agency_id' => $model['agency_id'],
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
            'name' => $model['name'],
            'icon' => $model['icon'],
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

    /**
     * @param string $name
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     */
    public function findByName(string $name, int $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('id', '!=', $id);

        return $query->where('name', 'LIKE', $name)->first();
    }

    private function getQuery(): Builder
    {
        $agency_id = Auth::user()->agency_id;

        return DB::table('departments')
            ->where('departments.agency_id', $agency_id);
    }

    public function getAll()
    {
        return $this->getQuery()->orderBy('departments.name')->select('id','name')->get();
    }


}

<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IServiceRepository;
use App\Utility\Helpers;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements IServiceRepository
{
    public function findById(int $id)
    {
        return $this->getQuery()
            ->select('department_services.*')
            ->where('department_services.id', $id)
            ->first();
    }
    public function existsByDepartment(int $department_id)
    {
        return $this->getQuery()->where('department_services.department_id', $department_id)->exists();
    }
    public function gets(int $recordPerPage): LengthAwarePaginator
    {
        $query = $this->getQuery()
            ->select('department_services.*', 'departments.name as department_name');

        $service_name = request()->input('service_name');

        if(!empty($service_name))
            $query->where('department_services.service_name', 'LIKE', "%$service_name%");

        return $query
            ->orderByDesc('id')
            ->paginate($recordPerPage)
            ->appends([
                'service_name' => $service_name
            ]);
    }

    public function insert(array $model): int
    {
        return  $this->getQuery()->insertGetId([
            'service_name' => $model['service_name'],
            'department_id' => $model['department_id'],
        ]);
    }

    /**
     * @param int $id
     * @param array $model
     * @return void
     * @throws \Exception
     */
    public function update(int $id, array $model)
    {
        $this->getQuery()->where('department_services.id', $id)->update([
            'department_services.service_name' => $model['service_name'],
            'department_services.department_id' => $model['department_id'],
            'department_services.updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id){
        $this->getQuery()->where('department_services.id', $id)->delete();
    }

    /**
     * @param string $service_name
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     * @throws \Exception
     */
    public function findByName(string $service_name, int $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('department_services.id', '!=', $id);

        return $query->where('department_services.service_name', 'LIKE', $service_name)->first();
    }

    /**
     * @throws \Exception
     */
    private function getQuery(): Builder
    {
        $agency_id = Helpers::GetAgencyId();

        return DB::table('department_services')
            ->join('departments', 'department_services.department_id', '=', 'departments.id')
            ->where('departments.agency_id', $agency_id);
    }

    /**
     * @param null $department_id
     * @return Collection
     * @throws \Exception
     */
    public function getAll($department_id = null): Collection
    {
        $query = $this->getQuery();
        if($department_id != null)
            $query->where('department_services.department_id', $department_id);

        return $query->select('department_services.id', 'department_services.service_name')
            ->orderBy('department_services.service_name')
            ->get();

        // TODO: Implement getAll() method.
    }
}

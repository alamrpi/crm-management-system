<?php

namespace App\Data\IRepositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface IServiceRepository
{
    public function findById(int $id);
    public function existsByDepartment(int $department_id);

    public function gets(int $recordPerPage): LengthAwarePaginator;

    public function insert(array $model): int;

    /**
     * @param int $id
     * @param array $model
     * @return void
     */
    public function update(int $id, array $model);

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id);

    /**
     * @param string $name
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     */
    public function findByName(string $service_name, int $id = null);

    public function getAll($department_id);
}

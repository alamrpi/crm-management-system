<?php

namespace App\Data\IRepositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IDepartmentRepository
{
    public function findById(int $id);

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
     */
    public function findByName(string $name, int $id = null);

    public function getAll();

}

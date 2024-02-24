<?php

namespace App\Data\IRepositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface IEmployeeRepository
{
    public function findById(int $id);

    public function gets(int $recordPerPage = null); //: LengthAwarePaginator;

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
     * @param string $email
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     */
    public function findByEmail(string $email, int $id = null);

    public function getForDDL($type = null, $project_id = null, $dept_id = null);
    public function getAllEmployeeType();
    public function profileByUserId($userId);
}

<?php

namespace App\Data\IRepositories;

interface IAgencyRepository
{
    public function gets(int $recordPerPage);

    public function insert(array $model);
    public function update(int $id, array $model);
    public function delete(int $id);
    public function toggleStatus(int $id, $status);
    public function findById(int $id);
    public function findByEmail($email, $id = null);
    public function findByName($name, $id = null);

}

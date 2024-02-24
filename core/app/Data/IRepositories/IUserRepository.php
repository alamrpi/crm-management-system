<?php

namespace App\Data\IRepositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function insert($model);

    public function update($user_id, array $model, string $role_name);

    public function delete($user_id);
    public function deactive($user_id);

    public function getUserById(int $id);
    public function findByEmail($email);

    public function updateAgencyId(int $user_id, int $agency_id);

    public function getById($user_id);
    public function getCurrentUser();

    public function gets(int $recordPerPage = null); //: LengthAwarePaginator;

    public function getSocialLink($id);

    public function storeSocialLink($id, array $model);

    public function deleteSocialLink($id, $media_id);

    public function getUserCvs($id);

    public function storeCv($id, array $model);

    public function deleteCv($id, $cv_id);

    public function getSocialNetworks();

}

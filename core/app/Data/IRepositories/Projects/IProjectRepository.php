<?php

namespace App\Data\IRepositories\Projects;

interface IProjectRepository
{
    public function gets($recordPerPage, $user_id = null);
    public function store(array $model):int;
    public function cancel($id);
    public function delete($id);

    public function getById(int $id);

    public function update(array $model, $id);
    public function getByIdForTopView($id);
    public function getDepartmentById(int $id);
    public function exists($id);
    public function updateStatus($status, $id);
    public function isAllTaskComplete($id);
    public function getAllProjects();
    public function getProjectsByUserId($userId, $recordPerPage);
    public function getProjectsByClientId($clientId, $recordPerPage = 0);
    public function getProjectsBySlug($slug);
    public function getForDdl($user_id = null);
}

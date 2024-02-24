<?php

namespace App\Data\IRepositories\Projects;

interface IProjectServiceRepository
{
    public function store(array $model, $project_id): int;
    public function update(array $model, $purchase_service_id,$model2=null);

    public function getServices(int $project_id);
    public function getDepartments(int $project_id);
    public function existsByService(int $service_id);

    public function delete($service_id, $id);

    public function getServiceDepartments(int $project_id);

    public function getServicesByDepartment(int $id, int $department_id);
    public function getServiceByPurchaseId(int $service_id,  $requestType = null);

}

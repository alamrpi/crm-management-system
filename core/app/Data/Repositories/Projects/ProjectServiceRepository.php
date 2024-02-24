<?php

namespace App\Data\Repositories\Projects;

use App\Constants\PurchaseType;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectServiceRepository implements IProjectServiceRepository
{
    public function store(array $model, $project_id): int
    {
        DB::beginTransaction();
        $id = DB::table('project_purchase_services')->insertGetId([
            'project_id' => $project_id,
            'dept_id' => $model['department_id'],
            'service_id' => $model['service_id'],
            'purchase_type' => $model['purchase_type'],
            'total_hour' => $model['total_hour'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if($model['purchase_type'] == PurchaseType::PER_DAY_HOUR){
            DB::table('project_ps_service_per_days')->insert([
                'project_ps_id' => $id,
                'hour' => $model['hour'],
                'number_of_employee' => $model['number_of_employee'],
                'working_day' => $model['working_day']
            ]);
        }

        $this->updateProjectEntryComplete(1, $project_id);

        DB::commit();
        return $id;
    }

    public function update(array $model, $purchase_service_id, $model2 = null){
        $model['updated_at'] = date('Y-m-d H:i:s');
        $query = DB::table('project_purchase_services')->where('id', $purchase_service_id);
        if ($query->count()) {
            $purchaseService = $query->update($model);
            if ($model['purchase_type'] == PurchaseType::FIXED_HOUR){
                $q2 = DB::table('project_ps_service_per_days')->where('project_ps_id', '=',$purchase_service_id);
                if ($q2->count())
                    $q2->delete();
            }
            if($model2 && ($model['purchase_type'] == PurchaseType::PER_DAY_HOUR)){
                $query2 = DB::table('project_ps_service_per_days')->where('project_ps_id', '=', $purchase_service_id);
                if ($query2->count()) {
                    $query2->update($model2);

                }else{
                    DB::table('project_ps_service_per_days')->insert([
                        'project_ps_id' => $purchase_service_id,
                        'hour' => $model2['hour'],
                        'number_of_employee' => $model2['number_of_employee'],
                        'working_day' => $model2['working_day']
                    ]);
                }
            }
            return $purchaseService;
        }
        return false;
    }

    public function existsByService(int $service_id){
        return DB::table('project_purchase_services')->where('service_id', $service_id)->exists();
    }

    /**
     * Get services by project
     *
     * @param int $project_id
     * @return Collection
     */
    public function getServices(int $project_id): Collection
    {
        return DB::table('project_purchase_services')
            ->join('department_services', 'project_purchase_services.service_id', '=', 'department_services.id')
            ->join('departments', 'department_services.department_id', '=', 'departments.id')
            ->leftJoin('project_ps_service_per_days', 'project_purchase_services.id', '=', 'project_ps_service_per_days.project_ps_id')
            ->where('project_purchase_services.project_id', '=', $project_id)
            ->orderBy('project_purchase_services.id')
            ->select('project_purchase_services.*', 'project_ps_service_per_days.*', 'department_services.service_name', 'department_services.department_id', 'departments.name as department_name', 'departments.icon')
            ->get();
    }

    public function getServiceByPurchaseId(int $service_id, $requestType = null)
    {
        $query = DB::table('project_purchase_services')
            ->where('project_purchase_services.id', $service_id);
        if ($requestType === 2)
            $query->join('project_ps_service_per_days', 'project_ps_service_per_days.project_ps_id', '=', 'project_purchase_services.id');
        return $query->first();
    }

    public function getDepartments(int $project_id){
        return DB::table('project_purchase_services')
            ->join('departments', 'project_purchase_services.dept_id', '=', 'departments.id')
            ->select('departments.*')
            ->distinct()
            ->get();
    }

    public function delete($service_id, $id)
    {
        DB::beginTransaction();
        DB::table('project_purchase_services')
            ->where('id', $service_id)
            ->where('project_id', $id)
            ->delete();

        $entry_complete = DB::table('project_purchase_services')->where('project_id', $id)->count() > 0 ? 1 : 0;
        $this->updateProjectEntryComplete($entry_complete, $id);
        DB::commit();
    }

    private function updateProjectEntryComplete($status, $id){
        DB::table('projects')->where('id', $id)->update([
            'entry_complete' => $status
        ]);
    }

    public function getServiceDepartments(int $project_id): Collection
    {
       return DB::table('project_purchase_services')
           ->where('project_id', $project_id)
           ->join('departments', 'project_purchase_services.dept_id', '=', 'departments.id')
           ->distinct()
           ->select('departments.id', 'departments.name')
           ->get();
    }

    public function getServicesByDepartment(int $id, int $department_id): Collection
    {
        return DB::table('project_purchase_services')
            ->where('project_id', $id)
            ->where('dept_id', $department_id)
            ->join('department_services', 'project_purchase_services.service_id', '=', 'department_services.id')
            ->select('project_purchase_services.id', 'department_services.service_name as name')
            ->get();
    }
}

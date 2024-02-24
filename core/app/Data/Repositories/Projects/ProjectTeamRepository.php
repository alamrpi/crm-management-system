<?php

namespace App\Data\Repositories\Projects;

use App\Constants\EmployeeTypes;
use App\Constants\PurchaseType;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Models\Employee;
use App\Models\Project\ProjectTeamMember;
use App\Utility\Helpers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectTeamRepository implements IProjectTeamRepository
{
    /**
     * Get services by project
     *
     * @param int $project_id
     * @param string|null $name
     * @return Collection
     */
    public function gets(int $project_id, string $name = null): Collection
    {
        $employeeType = request()->input('employee_type');
        $name = $name ? $name : request()->input('emp_name');
        $query =  DB::table('project_team_members')
            ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->where('project_team_members.project_id', '=', $project_id)
            ->where('users.deactivated', '=', 0)
            ->orderBy('project_team_members.id')
            ->select('project_team_members.*','users.id as user_id', 'users.name', 'users.photo', 'employees.designation', 'employees.employee_type_id as employee_type', 'departments.id as dept_id', 'departments.name as dept_name');

        $employee_type_id = request()->input('employee_type_id');
        if ($employee_type_id)
            $query->where('employees.employee_type_id', '=', $employee_type_id);

        if ($name != null)
            $query->where('users.name', 'LIKE', '%'.$name.'%');
        if ($employeeType)
            $query->where('employees.employee_type_id', '=', $employeeType);
        return $query->get();
    }

    /**
     * Get services by project
     *
     * @param int $project_id
     * @param int $recordPerPage
     * @param string|null $name
     * @return LengthAwarePaginator
     */
    public function getsWithPagination(int $project_id, int $recordPerPage, string $name = null): LengthAwarePaginator
    {
        $employeeType = request()->input('employee_type');
        $name = $name ? $name : request()->input('emp_name');
        $query =  DB::table('project_team_members')
            ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->where('project_team_members.project_id', '=', $project_id)
            ->orderBy('project_team_members.id')
            ->select('project_team_members.*','users.id as user_id', 'users.name', 'users.photo', 'employees.designation', 'employees.employee_type_id as employee_type', 'departments.id as dept_id', 'departments.name as dept_name');

        $employee_type_id = request()->input('employee_type_id');
        if ($employee_type_id)
            $query->where('employees.employee_type_id', '=', $employee_type_id);

        if ($name != null)
            $query->where('users.name', 'LIKE', '%'.$name.'%');
        if ($employeeType)
            $query->where('employees.employee_type_id', '=', $employeeType);
        return $query->paginate($recordPerPage);
    }

    public function count($id)
    {
        $members =  DB::table('project_team_members')
            ->where('project_team_members.project_id', '=', $id)
            ->select('project_team_members.employee_type')
            ->get();

        return [
            'total' => count($members),
            'manager' => count($members->where('employee_type', EmployeeTypes::MANAGER)),
            'executive' => count($members->where('employee_type', EmployeeTypes::EXECUTIVE)),
        ];
    }

    public function removeMember($access_id)
    {
        DB::table('project_team_members')
            ->where('id', $access_id)
            ->delete();
    }

    /**
     * @inheritDoc
     */
    public function getForDdl(int $project_id, int $department_id = null)
    {
        $query = DB::table('project_team_members')
            ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->where('project_team_members.project_id', $project_id);

        if($department_id != null){
            $query->where('employees.department_id', '=', $department_id);
        }

        return $query->select('users.id', 'users.name')->get();

    }

    public function getAllForDdl()
    {
        return DB::table('project_team_members')
            ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->distinct()
            ->select('users.id', 'users.name as member_name')
            ->get();
    }
}

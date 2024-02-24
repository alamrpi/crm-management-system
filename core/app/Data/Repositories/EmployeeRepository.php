<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IEmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements IEmployeeRepository
{
    public function findById(int $id)
    {
        return $this->getQuery()
            ->select('employees.*', 'users.name', 'users.email')
            ->where('employees.id', $id)
            ->first();
    }
    public function gets(int $recordPerPage = null)//: LengthAwarePaginator
    {
        $query = $this->getQuery()
            ->join('roles', 'employees.employee_type_id', '=', 'roles.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.*', 'users.name','users.photo', 'users.email', 'departments.name as department_name', 'roles.role_name as employee_type',
            DB::raw('(SELECT COUNT(project_team_members.id) FROM project_team_members WHERE project_team_members.employee_id = employees.id) as total_projects'),
            DB::raw('(SELECT COUNT(task_assign_tos.task_id) FROM task_assign_tos WHERE task_assign_tos.team_member_id = employees.user_id) as total_tasks'));

        $name = request()->input('name');
        $email = request()->input('email');
        $department_id = request()->input('department_id');

        if(!empty($name))
            $query->where('users.name', 'LIKE', "%$name%");
        if(!empty($email))
            $query->where('users.email', 'LIKE', "%$email%");

        if(!empty($department_id))
            $query->where('employees.department_id', '=', $department_id);

        if ($recordPerPage === null) {
            return $query
                ->orderByDesc('employees.id')
                ->get();
        }
        return $query
            ->orderByDesc('employees.id')
            ->paginate($recordPerPage)
            ->appends([
                'name' => $name,
                'email' => $email
            ]);
    }

    public function insert(array $model): int
    {
        return $this->getQuery()->insertGetId([
            'employee_type_id' => $model['employee_type_id'],
            'designation' => $model['designation'],
            'department_id' => $model['department_id'],
            'user_id' => $model['user_id'],
            'created_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @param array $model
     * @return void
     */
    public function update(int $id, array $model)
    {
        $this->getQuery()
            ->where('employees.id', $id)
            ->update([
                'employee_type_id' => $model['employee_type_id'],
                'designation' => $model['designation'],
                'department_id' => $model['department_id'],
                'employees.updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id){
        $this->getQuery()
            ->where('employees.id', $id)
            ->delete();
    }

    /**
     * @param string $email
     * @param int|null $id ignore id
     * @return Model|Builder|object|null
     */
    public function findByEmail(string $email, int $id = null)
    {
        $query = $this->getQuery();

        if($id != null)
            $query->where('employees.id', '!=', $id);
        return $query->where('users.email', 'LIKE', "%$email%")->first();
    }

    private function getQuery(): Builder
    {
        $agency_id = Auth::user()->agency_id;
        return DB::table('employees')
            ->where('users.deactivated', 0)
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->where('users.agency_id', '=',$agency_id);

    }

    /**
     * Gets employee as list for the dropdown value
     *
     * @param null $type Employee Type. This is optional if type is pass then filter based on employee type or return the all employee.
     * @return Collection list of employee
     */
    public function getForDDL($type = null, $project_id = null, $dept_id = null): Collection
    {
        $query = $this->getQuery();

        if($type != null)
            $query->where('employees.employee_type_id', '=', $type);
        if ($project_id != null) {
            $query->
            whereNotIn('employees.id', function ($query) use ($project_id) {
                $query->select('employee_id')->from('project_team_members')->where('project_id', '=', $project_id);
            });
        }
        if ($dept_id != null){
            $query->where('department_id', $dept_id);
        }

        return $query->orderBy('users.name')
            ->select('employees.id', 'users.name', 'employees.user_id', 'employees.employee_type_id as employee_type')
            ->get();
    }
    public function getAllEmployeeType()
    {
        return DB::table('employees')->select('employee_type_id as employee_type')->distinct()->get();
    }

    public function profileByUserId($userId)
    {
        return DB::table('employees')
            ->where('users.deactivated', 0)
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->where('users.id', '=', $userId)
            ->select('users.*', 'employees.designation', 'employees.employee_type_id as employee_type','employees.created_at as join_date', 'departments.name as dept_name')->first();
    }
}

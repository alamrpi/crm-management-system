<?php

namespace App\Data\Repositories\Projects;

use App\Constants\EmployeeTypes;
use App\Constants\ProjectStatus;
use App\Constants\TaskStatus;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Models\Project\Project;
use App\Utility\Generator;
use App\Utility\Helpers;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements IProjectRepository
{
    /**
     * @param $recordPerPage
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function gets($recordPerPage, $user_id = null): LengthAwarePaginator
    {
        $query = $this->getQuery()
            ->where('projects.entry_complete', '=', 1);

        if($user_id != null){
            $query->join('project_team_members', 'project_team_members.project_id', '=', 'projects.id')
                ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
                ->where('employees.user_id', $user_id)
                ->orWhere('projects.created_by', $user_id);
        }
        $project_name = request()->input('project_name');
        $client_id = request()->input('client_id');
        $priority = request()->input('priority');
        $status = request()->input('status');

        if(!empty($project_name))
            $query->where('projects.project_name', 'LIKE', "%$project_name%");
        if(!empty($client_id))
            $query->where('projects.client_id', '=', $client_id);
        if(!empty($priority))
            $query->where('projects.priority', '=', $priority);
        if(!empty($status))
            $query->where('projects.status', '=', $status);

        return $query->select('projects.*', 'clients.address as client_address', 'users.name as client_name')
            ->distinct()
            ->orderByDesc('projects.id')
            ->paginate($recordPerPage)
            ->appends([
                'project_name' => $project_name,
                'client_id' => $client_id,
                'priority' => $priority,
                'status' => $status
            ]);
    }


    /**
     * @param int $id
     * @return Collection
     * @throws Exception
     */
    public function getDepartmentById(int $id): Collection
    {
        $query = $this->getQuery();
        return $query->join('project_purchase_services','projects.id','=','project_purchase_services.project_id')
            ->join('departments', 'project_purchase_services.dept_id', '=', 'departments.id')
            ->where('project_purchase_services.project_id', $id)
            ->select('departments.id','departments.name')
            ->groupBy('project_purchase_services.dept_id')
            ->get();
    }

    /**
     * @param int $id
     * @return Model|Builder|object|null
     * @throws Exception
     */
    public function getById(int $id)
    {
        $query = $this->getQuery();

        return $query->where('projects.status', '!=', ProjectStatus::CANCELED)
            ->where('projects.id', $id)
            ->select('projects.*')
            ->first();
    }

    /**
     * @throws Exception
     */
    public function store(array $model): int
    {
        DB::beginTransaction();
        $id = DB::table('projects')->insertGetId([
            'agency_id' => Helpers::GetAgencyId(),
            'client_id' => $model['client_id'],
            'project_name' => $model['project_name'],
            'slug' => Generator::generateSlug($model['project_name'], Project::query()),
            'description' => $model['description'],
            'priority' => $model['priority'],
            'status' => $model['status'],
            'deadline' => $model['deadline'],
            'target' => $model['target'],
            'thumbnail' => $model['thumbnail'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::id(),
        ]);
        DB::commit();
        return $id;
    }

    /**
     * @param $id
     * @return void
     */
    public function cancel($id)
    {
        DB::table('projects')
            ->where('id', $id)
            ->update([
                'status' => ProjectStatus::CANCELED
            ]);
    }

    public function updateStatus($status, $id)
    {
        DB::table('projects')
            ->where('id', $id)
            ->update([
                'status' => $status
            ]);
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        DB::table('projects')
            ->where('id', $id)
            ->delete();
    }

    /**
     * @return Builder
     * @throws Exception
     */
    private function getQuery(): Builder
    {
        return DB::table('projects')
            ->join('clients', 'projects.client_id', '=', 'clients.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->where('projects.agency_id', '=', Helpers::GetAgencyId());
    }

    /**
     * @param array $model
     * @param $id
     * @return void
     */
    public function update(array $model, $id)
    {
        DB::beginTransaction();
        DB::table('projects')->where('id', $id)->update([
            'client_id' => $model['client_id'],
            'project_name' => $model['project_name'],
            'slug' => Generator::generateSlug($model['project_name'], Project::query(), $id),
            'description' => $model['description'],
            'priority' => $model['priority'],
            'status' => $model['status'],
            'deadline' => $model['deadline'],
            'target' => $model['target'],
            'thumbnail' => $model['thumbnail'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::commit();
    }

    /**
     * @param array $model
     * @param int $id
     * @param array $teamMembers
     * @return void
     */
    public function addTeamMembers(array $model, int $id, array $teamMembers): void
    {
        if (count($model['manager_ids']) > 0) {
            foreach ($model['manager_ids'] as $employee_id)
                $teamMembers[] = [
                    'project_id' => $id,
                    'employee_id' => $employee_id,
                    'employee_type' => EmployeeTypes::MANAGER
                ];
        }
        //add Executives
        if (count($model['executive_ids']) > 0) {
            foreach ($model['executive_ids'] as $employee_id)
                $teamMembers[] = [
                    'project_id' => $id,
                    'employee_id' => $employee_id,
                    'employee_type' => EmployeeTypes::EXECUTIVE
                ];
        }

        DB::table('project_team_members')->insert($teamMembers);
    }

    /**
     * @throws Exception
     */
    public function getByIdForTopView($id)
    {
        $query = $this->getQuery();

        return $query->where('projects.status', '!=', ProjectStatus::CANCELED)
            ->where('projects.id', $id)
            ->select('projects.*', 'users.name as  client_name', 'clients.address')
            ->first();
    }

    /**
     * @throws Exception
     */
    public function exists($id): bool
    {
        return $this->getQuery()->where('projects.id', $id)->exists();
    }

    public function isAllTaskComplete($id){
        $query = $this->getQuery();
        $query->where('projects.id', $id);
        $query->whereExists(function($q)use($id){
            $q->select(DB::raw(1))->from('tasks')->where('project_id', '=', $id)->where('status', '<', TaskStatus::COMPlETE)->where('status', '!=', TaskStatus::COMPlETE);
        });
        return $query->count();
    }
    public function getAllProjects(){
        $query = $this->getQuery();
        return $query->get();
    }

    public function getProjectsByUserId($userId, $recordPerPage = 0)
    {
        $query = $this->getQuery()
            ->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
            ->join('employees', 'project_team_members.employee_id', '=', 'employees.id')
            ->where('projects.status', '!=', ProjectStatus::CANCELED)
            ->where('employees.user_id', '=', $userId)
            ->select('projects.*');
            if ($recordPerPage)
                return $query->paginate($recordPerPage);
            return $query->get();
    }

    public function getProjectsByClientId($clientId, $recordPerPage = 0)
    {
        $query = Project::where('projects.client_id', '=', $clientId)
            ->orderBy('projects.id', 'desc');
        if ($recordPerPage == 1)
            return $query->first()->toArray();
        if ($recordPerPage & $recordPerPage !=1)
            return $query->paginate($recordPerPage);
        return $query->get();
    }
    public function getProjectsBySlug($slug)
    {
        return $this->getQuery()->where('projects.client_id', '=', $slug)->first();
    }

    public function getForDdl($user_id = null)
    {
        $query = DB::table('projects');
        if ($user_id != null)
            $query->join('project_team_members', 'projects.id', '=', 'project_team_members.project_id')
                ->join('employees', 'project_team_members.employee_id', '=' ,'employees.id')
                ->where('employees.user_id', $user_id);
        return $query
            ->distinct()
            ->select('projects.id', 'projects.project_name')
            ->get();
    }
}

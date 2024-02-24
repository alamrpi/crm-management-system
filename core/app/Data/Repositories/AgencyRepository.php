<?php

namespace App\Data\Repositories;

use App\Data\IRepositories\IAgencyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class AgencyRepository implements IAgencyRepository
{
    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|Builder|object|null
     */
    public function findById(int $id)
    {
        return $this->getQuery()->where('id', $id)->first();
    }
    public function gets(int $recordPerPage): LengthAwarePaginator
    {
        $query = $this->getQuery();
        $name = request()->input('name');
        $status = request()->input('status');

        if(!empty($name))
            $query->where('agencies.name', 'LIKE', "%$name%");

        if(!empty($status))
            $query->where('agencies.deactivated', '=', $status);

        return $query
            ->select('agencies.*', DB::raw('(SELECT users.name FROM users WHERE users.agency_id = agencies.id AND users.role = \'admin\') as user_name'))
            ->orderByDesc('agencies.id')
            ->paginate($recordPerPage)
            ->appends([
            'name' => $name,
            'status' => $status
        ]);
    }

    public function insert(array $model): int
    {
        return DB::table('agencies')->insertGetId([
            'agency_id' => $model['agency_id'],
            'name' => $model['agency_name'],
            'tagline' => $model['tagline'],
            'email' => $model['email'],
            'address' => $model['address'],
            'website' => $model['website'],
            'logo' => $model['logo'],
            'about' => $model['about'],
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
        $this->getQuery()->where('id', $id)->update([
            'name' => $model['agency_name'],
            'tagline' => $model['tagline'],
            'email' => $model['email'],
            'address' => $model['address'],
            'website' => $model['website'],
            'logo' => $model['logo'],
            'about' => $model['about'],
            'updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id){
        $this->getQuery()->where('id', $id)->delete();
    }
    /**
     * @param string $email
     * @param int $id ignore id
     * @return void
     */
    public function findByEmail($email, $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('id', '!=', $id);

        $query->where('email', '=', $email)->first();
    }

    /**
     * @param string $name
     * @param int $id ignore id
     * @return void
     */
    public function findByName($name, $id = null)
    {
        $query = $this->getQuery();
        if($id != null)
            $query->where('id', '!=', $id);

        $query->where('name', 'LIKE', $name)->first();
    }

    private function getQuery(): Builder
    {
        return DB::table('agencies');
    }

    /**
     * Status toggle action
     * @param int $id
     * @return void
     */
    public function toggleStatus(int $id, $status)
    {
        $this->getQuery()->where('id', $id)->update([
            'deactivated' => $status
        ]);
    }
}

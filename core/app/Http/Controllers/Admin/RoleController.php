<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRoles;
use App\Data\IRepositories\Auth\IAccessRepository;
use App\Data\IRepositories\Auth\IRoleAccessRepository;
use App\Data\IRepositories\IAgencyRepository;
use App\Data\IRepositories\IRoleRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Agency\CreateAdminRequest;
use App\Http\Requests\SuperAdmin\Agency\SaveAgencyRequest;
use App\Http\Requests\SuperAdmin\Settings\SaveRoleRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * @var IUserRepository
     */
    private $userRepository;
    /**
     * @var IRoleRepository
     */
    private $roleRepository;
    /**
     * @var IAccessRepository
     */
    private $accessRepository;
    /**
     * @var IRoleAccessRepository
     */
    private $roleAccessRepository;

    /**
     * @param IRoleRepository $roleRepository
     * @param IUserRepository $userRepository

     * @param IAccessRepository $accessRepository
     */
    public function __construct(IRoleRepository $roleRepository, IUserRepository $userRepository, IAccessRepository $accessRepository, IRoleAccessRepository $roleAccessRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->accessRepository = $accessRepository;
        $this->roleAccessRepository = $roleAccessRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;
            $roles = $this->roleRepository->gets($recordPerPage);
            foreach ($roles as $role){
                $role->accesses = $this->roleAccessRepository->getAccessesByRole($role->id);
            }
            return view('admin.pages.role.index', [
                'rows' => $roles
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        return view('admin.pages.role.create');
    }

    public function store(SaveRoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->roleRepository->findByName($model['role_name'])))
                return redirect()->back()->with('error_msg', "Duplicate role name not allowed!")->withInput();

            $this->roleRepository->insert($model);
            DB::commit();
            return redirect()->route('admin/role/index')->with('success_msg', "Role has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        try {
            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return redirect()->route('admin/role/index')->with('error_msg', "Request not valid");
          
            return view('admin.pages.role.edit', [
                'role' => $role
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update($id, SaveRoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return view('admin.shared.404');

            if(!empty($this->roleRepository->findByName($model['role_name'], $id)))
                return redirect()->back()->with('admin/role/index', "Duplicate name not allowed!")->withInput();

            $this->roleRepository->update($id, $model);
            DB::commit();
            return redirect()->route('admin/role/index')->with('success_msg', "Role has been updated successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return view('admin.shared.404');

            if($this->roleRepository->existsInEmployee($id))
            {
                return redirect()->route('admin/role/index')->with('error_msg', "Role has been used");
            }
            $this->roleRepository->delete($id);


            DB::commit();
            return redirect()->route('admin/role/index')->with('success_msg', "Role has been deleted successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function assignAccess($id)
    {
        try {

            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return view('admin.shared.404');

            return view('admin.pages.role.assign-access', [
                'role' => $role,
                'accesses' => $this->accessRepository->gets(),
                'accesses_ids' => $this->roleAccessRepository->getAssignedAccessIds($id)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function assignAccessStore($id)
    {
        try {

            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return view('admin.shared.404');

            $this->roleAccessRepository->store($id, request()->input('access_ids'));

            return redirect()->route('admin/role/index')->with('success_msg', "Access assigned in role");
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

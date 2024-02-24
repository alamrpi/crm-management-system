<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Constants\UserRoles;
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
     * @param IRoleRepository $roleRepository
     * @param IUserRepository $userRepository
     */
    public function __construct(IRoleRepository $roleRepository, IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('super-admin.pages.settings.role.index', [
                'rows' => $this->roleRepository->gets($recordPerPage)
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        return view('super-admin.pages.settings.role.create');
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
            return redirect()->route('settings/role/index')->with('success_msg', "Role has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        try {
            $role = $this->roleRepository->findById($id);
            if(empty($role))
                return redirect()->route('settings/role/index')->with('error_msg', "Request not valid");

            return view('super-admin.pages.settings.role.edit', [
                'role' => $role
            ]);

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
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
                return redirect()->route('settings/role/index')->with('error_msg', "Request not valid");

            if(!empty($this->roleRepository->findByName($model['role_name'], $id)))
                return redirect()->back()->with('settings/role/index', "Duplicate name not allowed!")->withInput();

            $this->roleRepository->update($id, $model);
            DB::commit();
            return redirect()->route('settings/role/index')->with('success_msg', "Role has been updated successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
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
                return redirect()->route('settings/role/index')->with('error_msg', "Request not valid.");

            $this->roleRepository->delete($id);
            DB::commit();
            return redirect()->route('settings/role/index')->with('success_msg', "Role has been deleted successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

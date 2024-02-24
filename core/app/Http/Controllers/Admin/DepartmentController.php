<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRoles;
use App\Data\IRepositories\IAgencyRepository;
use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IRoleRepository;
use App\Data\IRepositories\IServiceRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\SaveDepartmentRequest;
use App\Http\Requests\SuperAdmin\Agency\CreateAdminRequest;
use App\Http\Requests\SuperAdmin\Agency\SaveAgencyRequest;
use App\Http\Requests\SuperAdmin\Settings\SaveRoleRequest;
use App\Models\User;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DepartmentController extends Controller
{

    private $departmentRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    private $serviceRepository;

    /**
     * @param IDepartmentRepository $departmentRepository
     */
    public function __construct(IDepartmentRepository $departmentRepository, IFileOperationService $fileOperationService, IServiceRepository $serviceRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->fileOperationService = $fileOperationService;
        $this->serviceRepository = $serviceRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('admin.pages.department.index', [
                'rows' => $this->departmentRepository->gets($recordPerPage)
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        return view('admin.pages.department.create');
    }

    public function store(SaveDepartmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->departmentRepository->findByName($model['name'])))
                return redirect()->back()->with('error_msg', "Duplicate department name not allowed!")->withInput();

            $model['agency_id'] = Auth::user()->agency_id;
            if(!empty($model['icon']))
            {
                $fileInfo = $this->fileOperationService->upload($model['icon'],"uploads/department/icon");
                $model['icon'] = $fileInfo['path'];
            }else
            {
                $model['icon'] = 'uploads/department/icon/default.png';
            }

            $this->departmentRepository->insert($model);
            DB::commit();
            return redirect()->route('admin/department/index')->with('success_msg', "Department has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        try {
            $department = $this->departmentRepository->findById($id);
            if(empty($department))
                return redirect()->route('admin/department/index')->with('error_msg', "Request not valid");

            return view('admin.pages.department.edit', [
                'department' => $department
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update($id, SaveDepartmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            $department = $this->departmentRepository->findById($id);
            if(empty($department))
                return redirect()->route('admin/department/index')->with('error_msg', "Request not valid");

            if(!empty($this->departmentRepository->findByName($model['name'], $id)))
                return redirect()->back()->with('admin/department/index', "Duplicate name not allowed!")->withInput();

            if(!empty($model['icon']))
            {
                if($department->icon != 'uploads/department/icon/default.png')
                    $this->fileOperationService->delete($department->icon);

                $fileInfo = $this->fileOperationService->upload( $model['icon'],"uploads/department/icon");
                $model['icon'] = $fileInfo['path'];
            }else{
                $model['icon'] = $department->icon;
            }

            $this->departmentRepository->update($id, $model);
            DB::commit();
            return redirect()->route('admin/department/index')->with('success_msg', "Department has been updated successfully");
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
            $department = $this->departmentRepository->findById($id);
            if(empty($department))
                return redirect()->route('admin/department/index')->with('error_msg', "Request not valid.");

            if($this->serviceRepository->existsByDepartment($id))
                return redirect()->route('admin/department/index')->with('error_msg', "This department used in service. You can't delete this.");

            if($department->icon != 'uploads/department/icon/default.png')
                $this->fileOperationService->delete($department->icon);

            $this->departmentRepository->delete($id);
            DB::commit();
            return redirect()->route('admin/department/index')->with('success_msg', "Department has been deleted successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

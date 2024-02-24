<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRoles;
use App\Data\IRepositories\Auth\IRoleAccessRepository;
use App\Data\IRepositories\IAgencyRepository;
use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\IRoleRepository;
use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\SaveDepartmentRequest;
use App\Http\Requests\Admin\Department\SaveEmployeeRequest;
use App\Http\Requests\SuperAdmin\Agency\CreateAdminRequest;
use App\Http\Requests\SuperAdmin\Agency\SaveAgencyRequest;
use App\Http\Requests\SuperAdmin\Settings\SaveRoleRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Services\Interfaces\IMailService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    private $fileOperationService;
    /**
     * @var IEmployeeRepository
     */
    private $employeeRepository;
    /**
     * @var IUserRepository
     */
    private $userRepository;
    /**
     * @var IRoleRepository
     */
    private $roleRepository;
    /**
     * @var IDepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var IMailService
     */
    private $mailService;
    /**
     * @var IRoleAccessRepository
     */
    private $roleAccessRepository;

    private $activityRepository;

    /**
     * @param IEmployeeRepository $employeeRepository
     * @param IFileOperationService $fileOperationService
     * @param IUserRepository $userRepository
     */
    public function __construct(IEmployeeRepository $employeeRepository,
                                IFileOperationService $fileOperationService,
                                IUserRepository $userRepository,
                                IRoleRepository $roleRepository,
                                IDepartmentRepository $departmentRepository,
                                IMailService $mailService,
                                IRoleAccessRepository $roleAccessRepository,
                                IProjectActivityRepository $activityRepository)
    {
        $this->fileOperationService = $fileOperationService;
        $this->employeeRepository = $employeeRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->departmentRepository = $departmentRepository;
        $this->mailService = $mailService;
        $this->roleAccessRepository = $roleAccessRepository;
        $this->activityRepository = $activityRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;
            $departments = $this->departmentRepository->getAll();

            return view('admin.pages.employee.index', [
                'rows' => $this->employeeRepository->gets($recordPerPage),
                'departments' => $departments
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        $departments = $this->departmentRepository->getAll();
        $types = $this->roleRepository->getAll();

        return view('admin.pages.employee.create',[
            'types' => $types,
            'departments' => $departments
        ]);
    }

    public function store(SaveEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->employeeRepository->findByEmail($model['email'])))
                return redirect()->back()->with('error_msg', "Duplicate department name not allowed!")->withInput();

            if(!empty($model['photo']))
            {
                $fileInfo = $this->fileOperationService->upload($model['photo'],"uploads/users/photo/");
                $model['photo'] = $fileInfo['path'];
            }else
            {
                $model['photo'] = 'uploads/users/photo/default.png';
            }

            $designation = $this->roleRepository->findById($model['employee_type_id']);
            $password = Generator::generateStrongPassword();
            $user_id = $this->userRepository->insert([
                'name' => $model['name'],
                'email' => $model['email'],
                'password' => 'user123',
//                'password' => $password,
                'photo' => $model['photo'],
                'role' => $designation->role_name,
                'agency_id' => Auth::user()->agency_id,
            ]);

            $model['user_id'] = $user_id;
            $this->employeeRepository->insert($model);

            $role_access_ids = $this->roleAccessRepository->getAssignedAccessIds($model['employee_type_id']);
            $permissions = [];
            foreach ($role_access_ids as $access_id) {
                $permissions[] = [
                    'user_id' => $user_id,
                    'access_id' => $access_id
                ];
            }

            DB::table('auth_permissions')->insert($permissions);

            //Send Mail
//            $view = [
//                'view_name' => 'email-templates.send-password',
//                'view_data' => (object)['password' => $password]
//            ];
//            $this->mailService->SentMail($view, ['email' => $model['email'], 'subject' => "Registered user password"]);

            DB::commit();
            return redirect()->route('admin/employee/index')->with('success_msg', "Employee has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        try {
            $employee = $this->employeeRepository->findById($id);
            $departments = $this->departmentRepository->getAll();
            $types = $this->roleRepository->getAll();
            if(empty($employee))
                return redirect()->route('admin/employee/index')->with('error_msg', "Request not valid");

            return view('admin.pages.employee.edit', [
                'employee' => $employee,
                'departments' => $departments,
                'types' => $types
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update($id, SaveEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            $employee = $this->employeeRepository->findById($id);
            if(empty($employee))
                return redirect()->route('admin/employee/index')->with('error_msg', "Request not valid");

            if(!empty($this->employeeRepository->findByEmail($model['email'], $id)))
                return redirect()->back()->with('admin/employee/index', "Duplicate email not allowed!")->withInput();

            $user = $this->userRepository->getById($employee->user_id);

            if(!empty($model['photo']))
            {
                if($user->photo != 'uploads/users/photo/default.png')
                    $this->fileOperationService->delete($user->photo);

                $fileInfo = $this->fileOperationService->upload($model['photo'],"uploads/users/photo/");
                $model['photo'] = $fileInfo['path'];
            }else{
                $model['photo'] = $user->photo;
            }

            $designation = $this->roleRepository->findById($model['employee_type_id']);
            $this->userRepository->update($employee->user_id, $model, $designation->role_name);
            $this->employeeRepository->update($id, $model);
            DB::commit();
            return redirect()->route('admin/employee/index')->with('success_msg', "Employee has been updated successfully");
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
            $employee = $this->employeeRepository->findById($id);
            if(empty($employee))
                return redirect()->route('admin/employee//index')->with('error_msg', "Request not valid.");

            $user = $this->userRepository->getById($employee->user_id);
            if($employee->photo != 'uploads/users/photo/default.png')
                $this->fileOperationService->delete($employee->photo);

            $this->userRepository->delete($user->user_id);
            $this->employeeRepository->delete($id);
            DB::commit();
            return redirect()->route('admin/employee/index')->with('success_msg', "Employee has been deleted successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function deactive($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->findById($id);
            if(empty($employee))
                return redirect()->route('admin/employee//index')->with('error_msg', "Request not valid.");

            $this->userRepository->deactive($employee->user_id);
            DB::commit();
            return redirect()->route('admin/employee/index')->with('success_msg', "Employee has been de-activated successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function details($id)
    {
        try {
            $user = Auth::user();
            $teams = $this->userRepository->getUserById($id);
            $socialLinks = $this->userRepository->getSocialLink($id);
            $profile = $this->employeeRepository->profileByUserId($id);
            $activities = $this->activityRepository->getsByUser($id, 10);
            return view('admin/pages/employee/profile', [
                'teams' => $teams,
                'profile' => $profile,
                'activities'=> $activities,
                'socialLinks' => $socialLinks
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

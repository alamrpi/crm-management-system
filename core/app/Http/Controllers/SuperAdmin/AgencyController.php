<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Constants\UserRoles;
use App\Data\IRepositories\IAgencyRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Agency\CreateAdminRequest;
use App\Http\Requests\SuperAdmin\Agency\SaveAgencyRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AgencyController extends Controller
{
    /**
     * @var IAgencyRepository
     */
    private $agencyRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @param IAgencyRepository $agencyRepository
     * @param IFileOperationService $fileOperationService
     * @param IUserRepository $userRepository
     */
    public function __construct(IAgencyRepository $agencyRepository, IFileOperationService $fileOperationService, IUserRepository $userRepository)
    {

        $this->agencyRepository = $agencyRepository;
        $this->fileOperationService = $fileOperationService;
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('super-admin.pages.agency.index', [
                'rows' => $this->agencyRepository->gets($recordPerPage)
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        return view('super-admin.pages.agency.create');
    }

    public function store(SaveAgencyRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if(!empty($this->agencyRepository->findByName($model['agency_name'])))
                return redirect()->back()->with('error_msg', "Duplicate name not allowed!")->withInput();

            if(!empty($this->agencyRepository->findByEmail($model['email'])))
                return redirect()->back()->with('error_msg', "Email already used!")->withInput();

            $model['agency_id'] = Generator::generateAgencyId();

            if(!empty($model['logo']))
            {
                $fileInfo = $this->fileOperationService->Crop( $model['logo'],"uploads/agency/logo", 100, 100);
                $model['logo'] = $fileInfo;
            }else{
                $model['logo'] = 'uploads/agency/logo/default.png';
            }

            $this->agencyRepository->insert($model);
            DB::commit();
            return redirect()->route('sa/agency/index')->with('success_msg', "Agency has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function details($id){
        try {
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid");

            return view('super-admin.pages.agency.details', [
                'agency' => $agency
            ]);

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        try {
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid");

            return view('super-admin.pages.agency.edit', [
                'agency' => $agency
            ]);

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update($id, SaveAgencyRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid");

            if(!empty($this->agencyRepository->findByName($model['agency_name'], $id)))
                return redirect()->back()->with('error_msg', "Duplicate name not allowed!")->withInput();

            if(!empty($this->agencyRepository->findByEmail($model['email'], $id)))
                return redirect()->back()->with('error_msg', "Email already used!")->withInput();

            if(!empty($model['logo']))
            {
                if($agency->logo != 'uploads/agency/logo/default.png')
                    $this->fileOperationService->delete($agency->logo);

                $fileInfo = $this->fileOperationService->Crop( $model['logo'],"uploads/agency/logo", 100, 100);
                $model['logo'] = $fileInfo;
            }else{
                $model['logo'] = $agency->logo;
            }

            $this->agencyRepository->update($id, $model);
            DB::commit();
            return redirect()->route('sa/agency/index')->with('success_msg', "Agency has been updated successfully");
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
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid.");

            if($agency->logo != 'uploads/agency/logo/default.png')
                $this->fileOperationService->delete($agency->logo);

            $this->agencyRepository->delete($id);
            DB::commit();
            return redirect()->route('sa/agency/index')->with('success_msg', "Agency has been deleted successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function toggleStatus($id)
    {
        DB::beginTransaction();
        try {
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid.");

            $this->agencyRepository->toggleStatus($id,  $agency->deactivated == 0 ? 1 : 0);
            DB::commit();
            return redirect()->route('sa/agency/index')->with('success_msg', "Agency status has been changed");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function createAdmin($id){
        try {
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid");

            return view('super-admin.pages.agency.create-admin', [
                'agency' => $agency
            ]);

        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function storeAdmin($id, CreateAdminRequest $request)
    {
        try {
            $agency = $this->agencyRepository->findById($id);
            if(empty($agency))
                return redirect()->route('sa/agency/index')->with('error_msg', "Request not valid.");

            $data = $request->validated();
            $this->userRepository->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => 'admin123',
                'agency_id' => $id,
                'role' => UserRoles::AGENCY_ADMIN,
                'photo' => 'uploads/users/photo/default.png'
            ]);
            return redirect()->route('sa/agency/index')->with('success_msg', "Agency admin has been created");
        }catch (\Exception $ex){
            return view('super-admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

}

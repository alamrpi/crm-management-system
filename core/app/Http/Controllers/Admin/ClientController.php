<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRoles;
use App\Data\IRepositories\IClientEnrollRepository;
use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\SaveClientRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use App\Utility\Helpers;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * @var IUserRepository
     */
    private $userRepository;
    /**
     * @var IClientRepository
     */
    private $clientRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var IClientEnrollRepository
     */
    private $clientEnrollRepository;

    public function __construct(IUserRepository $userRepository, IClientRepository $clientRepository, IFileOperationService $fileOperationService, IClientEnrollRepository $clientEnrollRepository)
    {

        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->fileOperationService = $fileOperationService;
        $this->clientEnrollRepository = $clientEnrollRepository;
    }
    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('admin.pages.client.index', [
                'rows' => $this->clientRepository->gets($recordPerPage)
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function create(): View
    {
        return view('admin.pages.client.create');
    }

    public function store(SaveClientRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();
            $agency_id = 0;

            if(!empty($this->userRepository->findByEmail($model['email'])))
                return redirect()->back()->with('error_msg', "Duplicate client email not allowed!")->withInput();

            if(!empty($model['photo']))
            {
                $fileInfo = $this->fileOperationService->upload($model['photo'],"uploads/users/clients/photo/");
                $model['photo'] = $fileInfo['path'];
            }else
            {
                $model['photo'] = 'uploads/users/clients/photo/default.png';
            }

            if(!empty($model['logo']))
            {
                $fileInfo = $this->fileOperationService->upload($model['logo'],"uploads/users/clients/logo/");
                $model['logo'] = $fileInfo['path'];
            }else
            {
                $model['logo'] = 'uploads/users/clients/logo/default.png';
            }

            $user_id = $this->userRepository->insert([
                'name' => $model['name'],
                'email' => $model['email'],
                'photo' => $model['photo'],
                'role' => UserRoles::CLIENT,
                'password' => 'user123',
                'agency_id' => $agency_id,
            ]);

            $model['user_id'] = $user_id;
            $model['client_id'] = Generator::generateClientId();
            $client_id = $this->clientRepository->insert($model);

            $this->clientEnrollRepository->insert([
                'client_id' => $client_id,
                'agency_id' => Helpers::GetAgencyId()
            ]);
            DB::commit();
            return redirect()->route('admin/client/index')->with('success_msg', "Client has been created successfully");
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function enroll(): View
    {
        return view('admin.pages.client.enroll');
    }

    public function enrollStore($id)
    {
        try {
            $agency_id = Helpers::GetAgencyId();
            $client = $this->clientRepository->findById($id);
            if(empty($client))
                return redirect()->route('admin/client/enroll')->with('error_msg', "Request not valid.");

            if($this->clientEnrollRepository->existsByAgencyId($agency_id, $id))
                return redirect()->route('admin/client/enroll')->with('error_msg', "This client already enrolled.");

            $this->clientEnrollRepository->insert([
                'client_id' => $id,
                'agency_id' => $agency_id
            ]);

            DB::commit();
            return redirect()->route('admin/client/enroll')->with('success_msg', "Client has been enrolled successfully");
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $client = $this->clientRepository->findById($id);
            if(empty($client))
                return redirect()->route('admin/client/index')->with('error_msg', "Request not valid");

            return view('admin.pages.client.edit', [
                'client' => $client,
            ]);

        }catch (Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function update($id, SaveClientRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            $client = $this->clientRepository->findById($id);
            if(empty($client))
                return redirect()->route('admin/client/index')->with('error_msg', "Request not valid");

            if(!empty($this->clientRepository->findByEmail($model['email'], $id)))
                return redirect()->back()->with('admin/client/index', "Duplicate email not allowed!")->withInput();

            $user = $this->userRepository->getById($client->user_id);
            if(!empty($model['photo']))
            {
                if($user->photo != 'uploads/users/clients/photo/default.png')
                    $this->fileOperationService->delete($user->photo);

                $fileInfo = $this->fileOperationService->upload($model['photo'],"uploads/users/clients/photo/");
                $model['photo'] = $fileInfo['path'];
            }else{
                $model['photo'] = $user->photo;
            }

            if(!empty($model['logo']))
            {
                if($client->logo != 'uploads/users/clients/logo/default.png')
                    $this->fileOperationService->delete($client->logo);

                $fileInfo = $this->fileOperationService->upload($model['logo'],"uploads/users/clients/logo/");
                $model['logo'] = $fileInfo['path'];
            }else{
                $model['logo'] = $client->logo;
            }
            $this->userRepository->update($client->user_id, $model, UserRoles::AGENCY_ADMIN);
            $this->clientRepository->update($id, $model);
            DB::commit();
            return redirect()->route('admin/client/index')->with('success_msg', "Client has been updated successfully");
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage().", File Name".$ex->getFile().", Line No:".$ex->getLine()
            ]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $client = $this->clientRepository->findById($id);
            if(empty($client))
                return redirect()->route('admin/client/index')->with('error_msg', "Request not valid.");

            $user = $this->userRepository->getById($client->user_id);
            if($user->photo != 'uploads/users/clients/photo/default.png')
                $this->fileOperationService->delete($user->photo);

            if($client->logo != 'uploads/users/clients/logo/default.png')
                $this->fileOperationService->delete($client->logo);

            $this->userRepository->delete($client->user_id);
            $this->clientRepository->delete($id);
            DB::commit();
            return redirect()->route('admin/client/index')->with('success_msg', "Client has been deleted successfully");
        }catch (Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }


    //Ajax function stare here

    /**
     * @return JsonResponse
     */
    public function getInfo(): JsonResponse
    {
        try {
            $client_id = request()->input('client_id');
            $client = $this->clientRepository->getClientId($client_id);
            if(empty($client))
                return response()->json([
                    'status' => 400,
                    'message' => 'Data Not found',
                ]);

            return response()->json([
                'status' => 200,
                'message' => '',
                'data' => \view('admin.pages.client._enroll-client-info', [
                    'client' => $client
                ])->render()
            ]);
        }catch (Exception $ex){
           return response()->json([
               'status' => 500,
               'Message' => "Internal Server Error"
           ]);
        }
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Constants\UserRoles;
use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @method middleware(string $string)
 */
class AccountController extends Controller
{
    /**
     * @var IClientRepository
     */
    private $clientRepository;
    /**
     * @var IUserRepository
     */
    private $userRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;

    public function __construct(IClientRepository $clientRepository, IUserRepository $userRepository, IFileOperationService $fileOperationService)
    {
        $this->middleware('guest');
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->fileOperationService = $fileOperationService;
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();

            if($this->userRepository->findByEmail($model['email']))
                return redirect()->back()->with('error_msg', "User already exists")->withInput();

            if(!empty($model['photo']))
            {
                $fileInfo = $this->fileOperationService->crop($model['photo'],"uploads/users/clients/", 100, 100);
                $model['photo'] = $fileInfo;
            }else
            {
                $model['photo'] = 'uploads/users/clients/default.png';
            }

            if(!empty($model['logo']))
            {
                $fileInfo = $this->fileOperationService->upload($model['logo'],"uploads/logos/clients/");
                $model['logo'] = $fileInfo['path'];
            }else
            {
                $model['logo'] = 'uploads/logos/clients/default.png';
            }

            $user_id = $this->userRepository->insert([
                'name' => $model['name'],
                'email' => $model['email'],
                'password' => $model['password'],
                'role' => UserRoles::CLIENT,
                'agency_id' => 0,
            ]);

            $model['user_id'] = $user_id;
            $model['client_id'] = Generator::generateClientId();
            $this->clientRepository->insert($model);
            DB::commit();
            return redirect()->route('login');
        }catch (\Exception $ex){
            DB::rollBack();
            return view('shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Data\IRepositories\Auth\IAccessRepository;
use App\Data\IRepositories\Auth\IPermissionsRepository;
use App\Data\IRepositories\IUserRepository;
use App\Http\Controllers\Controller;
use App\Utility\Helpers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var IUserRepository
     */
    private $userRepository;
    private $accessRepository;
    private $permissionRepository;

    public function __construct(IUserRepository $userRepository, IAccessRepository $accessRepository, IPermissionsRepository $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->accessRepository = $accessRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(): View
    {
        try {
            $recordPerPage = 20;

            return view('admin.pages.user.index', [
                'rows' => $this->userRepository->gets($recordPerPage),
            ])->with('i', Helpers::SerialCalculateForPage($recordPerPage));

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function permissions($user_id) {
        try {
            return view('admin.pages.user.permissions', [
                'user' => $this->userRepository->getById($user_id),
                'accesses' => $this->accessRepository->gets(),
                'assigned_accesses_ids' => $this->permissionRepository->getAccessIds($user_id)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function permissionsSaveChanges($user_id)
    {
        try {

            $user = $this->userRepository->getById($user_id);
            if(empty($user))
                return view('admin.shared.404');

            $this->permissionRepository->permissionSaveChanges($user_id, request()->input('access_ids'));

            return redirect()->route('admin/users/index')->with('success_msg', "User permissions saved changes");
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function ActivationToggle($user_id)
    {
        try {

            $user = $this->userRepository->getById($user_id);
            if(empty($user))
                return view('admin.shared.404');

            $this->permissionRepository->activationToggle($user_id, $user->deactivated);

            return redirect()->route('admin/users/index')->with('success_msg', $user->deactivated == 1 ? 'User has been activated' : 'User has been de-activated');
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

}

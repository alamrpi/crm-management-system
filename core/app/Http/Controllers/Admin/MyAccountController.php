<?php

namespace App\Http\Controllers\Admin;

use App\Data\IRepositories\IUserRepository;
use App\Http\Requests\Admin\Profile\MyProfileRequest;
use App\Http\Requests\StoreCvRequest;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Services\Interfaces\IFileOperationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class MyAccountController
{
    private $userRepository;
    private $fileOperationService;
    public function __construct(
        IUserRepository $userRepository,
        IFileOperationService $fileOperationService
    )
    {
        $this->userRepository = $userRepository;
        $this->fileOperationService = $fileOperationService;
    }

    public function myProfile(): View
    {
        $myId = Auth::user()->id;
        $profile = $this->userRepository->getUserById($myId);
        return view('admin.pages.my-account.my-profile', compact('profile'));
    }

    public function updateMyProfile(MyProfileRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $request->validated();
            $profile = $this->userRepository->getUserById(Auth::user()->id);
            if(!empty($model['photo']))
            {
                if($profile->photo != 'uploads/user/profile/default.png')
                    $this->fileOperationService->delete($profile->photo);
                $fileInfo = $this->fileOperationService->crop($model['photo'],"uploads/users/profile", 100, 100);
                $model['photo'] = $fileInfo;
            }else{
                $model['photo'] = $profile->photo;
            }
            $this->userRepository->update($profile->id, $model);
            DB::commit();
            return redirect()->back()->with([
                'success_msg' => 'Profile update complete!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function myAgency(): View
    {
        return view('admin.pages.my-account.my-agency');
    }

    public function changePassword(): View
    {
        return view('admin.pages.my-account.change-password');
    }

    public function updateChangePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = auth()->user();

            // Check if the current password matches the user's password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'The current password is incorrect.');
            }

            // Update the user's password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->back()->with([
                'success_msg' => 'User password has been changed!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function socialLinks(): View
    {
        $social_links = $this->userRepository->getSocialLink(Auth::id());
        $socialNetworks = $this->userRepository->getSocialNetworks();
        return view('admin.pages.my-account.social-links', [
            'social_links' => $social_links,
            'socialNetworks' => $socialNetworks
        ]);
    }

    public function storeSocialLinks(StoreSocialLinkRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $request->validated();
            $this->userRepository->storeSocialLink(Auth::id(), $model);
            DB::commit();
            return redirect()->back()->with([
                'success_msg' => 'User social link has been added!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function deleteSocialLinks($media_id)
    {
        try {
            $this->userRepository->deleteSocialLink(Auth::id(), $media_id);
            return redirect()->back()->with([
                'success_msg' => 'User social link has been deleted!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function cv(): View
    {
        $cvs = $this->userRepository->getUserCvs(Auth::id());
        return view('admin.pages.my-account.cv', ['cvs' => $cvs]);
    }

    public function storeCv(StoreCvRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $request->validated();
            $profile = $request->file('file');
            if(!empty($profile))
            {
                $fileInfo = $this->fileOperationService->upload($profile,"uploads/users/profile/cv");
                $model['file_path'] = $fileInfo['path'];
            }
            $this->userRepository->storeCv(Auth::id(), $model);
            DB::commit();
            return redirect()->back()->with([
                'success_msg' => 'user CV has been added!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function deleteCv($cv_id)
    {
        try {
            $cv = DB::table('user_cvs')->where('id', $cv_id)->first();
            if(!empty($cv)){
                $this->fileOperationService->delete($cv->file_path);
            }
            $this->userRepository->deleteCv(Auth::id(), $cv_id);
            return redirect()->back()->with([
                'success_msg' => 'User CV has been deleted!'
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}

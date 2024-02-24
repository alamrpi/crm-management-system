<?php

namespace App\Http\Controllers;

use App\Constants\UserRoles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): RedirectResponse
    {
        $user_role = Auth::user()->role;
        if($user_role == UserRoles::SUPER_ADMIN)
            return redirect()->route('sa/dashboard');
      
        if($user_role == UserRoles::CLIENT)
            return redirect()->route('clientarea/welcome');

        // if($user_role == UserRoles::AGENCY_ADMIN)
        //     return redirect()->route('admin/dashboard');
        return redirect()->route('admin/dashboard');
    }
}

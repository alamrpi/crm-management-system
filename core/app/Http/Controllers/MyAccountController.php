<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MyAccountController extends Controller
{
    public function profile(): View
    {
        return view('doctor.pages.my-account.profile');
    }

    public function personalDetails(): View
    {
        return view('doctor.pages.my-account.personal-details');
    }

    public function professionalDetails(): View
    {
        return view('doctor.pages.my-account.professional-details');
    }

    public function contactDetails(): View
    {
        return view('doctor.pages.my-account.contact-details');
    }

    public function changePassword(): View
    {
        return view('doctor.pages.my-account.change-password');
    }

}

<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MyPatientController extends Controller
{
    public function index(): View
    {
        return view('doctor.pages.my-patient.index');
    }

    public function details(): View
    {
        return view('doctor.pages.my-patient.details');
    }

    public function testReports(): View
    {
        return view('doctor.pages.my-patient.test-reports');
    }

    public function register(): View
    {
        return view('doctor.pages.my-patient.register');
    }

    public function enroll(): View
    {
        return view('doctor.pages.my-patient.register');
    }

}

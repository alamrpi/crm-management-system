<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DegreeController extends Controller
{
    public function index(): View
    {
        return view('doctor.pages.degree.index');
    }

    public function create(): View
    {
        return view('doctor.pages.degree.create');
    }

}

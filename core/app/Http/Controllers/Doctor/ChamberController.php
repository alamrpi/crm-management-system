<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChamberController extends Controller
{
    public function index(): View
    {
        return view('doctor.pages.chamber.index');
    }

    public function create(): View
    {
        return view('doctor.pages.chamber.create');
    }

    public function visitingTime(): View
    {
        return view('doctor.pages.chamber.visiting-time');
    }

}

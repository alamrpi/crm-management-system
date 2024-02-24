<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Utility\Helpers;
use Illuminate\Http\Request;

class RouteManagerController extends Controller
{
    public function index()
    {
        Helpers::throughError('Please select a project !', 4444);
    }
}

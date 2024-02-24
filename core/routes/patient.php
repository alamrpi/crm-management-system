<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'patient', 'middleware'=>['auth']], function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('patient/dashboard');

});

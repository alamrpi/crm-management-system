<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DashboardController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\Doctor\DegreeController;
use App\Http\Controllers\Doctor\ChamberController;
use App\Http\Controllers\Doctor\MyPatientController;

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

Route::group(['prefix'=>'doctor', 'middleware'=>['auth']], function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('doctor/dashboard');
    Route::get('/profile', [MyAccountController::class, 'profile'])->name('doctor/profile');
    Route::get('/personal-details', [MyAccountController::class, 'personalDetails'])->name('doctor/personal-details');
    Route::get('/professional-details', [MyAccountController::class, 'professionalDetails'])->name('doctor/professional-details');
    Route::group(['prefix'=>'degree'], function (){
        Route::get('/index', [DegreeController::class, 'index'])->name('doctor/degree/index');
        Route::get('/add', [DegreeController::class, 'create'])->name('doctor/degree/add');
    });
    Route::group(['prefix'=>'chamber'], function (){
        Route::get('/index', [ChamberController::class, 'index'])->name('doctor/chamber/index');
        Route::get('/add', [ChamberController::class, 'create'])->name('doctor/chamber/add');
        Route::get('{id}/visiting-time', [ChamberController::class, 'visitingTime'])->name('doctor/chamber/visitingTime');
    });
    Route::group(['prefix'=>'my-patient'], function (){
        Route::get('/index', [MyPatientController::class, 'index'])->name('doctor/myPatient/index');
        Route::get('{id}/details', [MyPatientController::class, 'details'])->name('doctor/myPatient/details');
        Route::get('{id}/test-reports', [MyPatientController::class, 'testReports'])->name('doctor/myPatient/testReports');
        Route::get('/register', [MyPatientController::class, 'register'])->name('doctor/myPatient/register');
        Route::get('/enroll', [MyPatientController::class, 'enroll'])->name('doctor/myPatient/enroll');
    });
    Route::get('/contact-details', [MyAccountController::class, 'contactDetails'])->name('doctor/contact-details');
    Route::get('/change-password', [MyAccountController::class, 'changePassword'])->name('doctor/change-password');
});

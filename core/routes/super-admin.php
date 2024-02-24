<?php

use App\Http\Controllers\SuperAdmin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\AgencyController;

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

Route::group(['prefix'=>'sa', 'middleware'=>['auth', 'SuperAdminGuard']], function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('sa/dashboard');

    Route::group(['prefix'=>'agency'], function() {
        Route::get('/index', [AgencyController::class, 'index'])->name('sa/agency/index');
        Route::get('/create', [AgencyController::class, 'create'])->name('sa/agency/create');
        Route::post('/store', [AgencyController::class, 'store'])->name('sa/agency/store');
        Route::get('/{id}', [AgencyController::class, 'details'])->name('sa/agency/details');
        Route::get('/{id}/edit', [AgencyController::class, 'edit'])->name('sa/agency/edit');
        Route::post('/{id}/update', [AgencyController::class, 'update'])->name('sa/agency/update');
        Route::get('/{id}/delete', [AgencyController::class, 'delete'])->name('sa/agency/delete');
        Route::get('/{id}/change-status', [AgencyController::class, 'toggleStatus'])->name('sa/agency/changeStatus');
        Route::get('{id}/create-admin', [AgencyController::class, 'createAdmin'])->name('sa/agency/createAdmin');
        Route::post('{id}/store-admin', [AgencyController::class, 'storeAdmin'])->name('sa/agency/storeAdmin');
    });

//    Route::group(['prefix' => 'settings'], function (){
//        //Role Related routes
//        Route::group(['prefix' => 'role'], function (){
//            Route::get('/index', [RoleController::class, 'index'])->name('settings/role/index');
//            Route::get('/create', [RoleController::class, 'create'])->name('settings/role/create');
//            Route::post('/store', [RoleController::class, 'store'])->name('settings/role/store');
//            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('settings/role/edit');
//            Route::post('/{id}/update', [RoleController::class, 'update'])->name('settings/role/update');
//            Route::get('/{id}/delete', [RoleController::class, 'delete'])->name('settings/role/delete');
//        });
//    });

});

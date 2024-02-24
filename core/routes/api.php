<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\PatientController;
use App\Http\Controllers\API\V1\PrescriptionController;
use App\Http\Controllers\API\V1\DoctorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1','middleware' => ['cors', 'json.response']], function()
{
    // public routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/verify-token', [AuthController::class, 'verifyToken']);
    Route::post('/register',[AuthController::class, 'register']);

    // authenticated route
    Route::middleware('auth:api')->group(function () {
        Route::post('/patient/store', [PatientController::class, 'store']);
        Route::post('/patient/index', [PatientController::class, 'index']);
        Route::get('/patient/details/{id}', [PatientController::class, 'view']);

        Route::get('/profile', [DoctorController::class, 'profile']);

        Route::post('/prescription/store', [PrescriptionController::class, 'store']);


        Route::group(['prefix'=>'my-account'], function (){

        });

        Route::post('/logout', 'API\V1\AuthController@logout');
    });


});

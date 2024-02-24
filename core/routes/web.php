<?php

use App\Http\Controllers\Auth\AccountController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('website.pages.landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register', [AccountController::class, 'register'])->name('home/register');

Route::get('/login', function(){
    return view('admin.temp.login');
})->name('login')->middleware('guest');

Route::get('/',function(){
    return redirect()->route('login');
});

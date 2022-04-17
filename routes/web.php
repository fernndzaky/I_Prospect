<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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


Route::get('/signin',[LoginController::class, 'index']);
Route::post('/signin', [LoginController::class, 'authenticate'])->name('signin');
Route::post('/signout', [LoginController::class, 'logout'])->name('signout');


Route::get('/signup',[RegisterController::class, 'index']);
Route::post('/register',[RegisterController::class, 'store'])->name('signup');


Route::get('/supervisor', function () {
    return view('supervisor/dashboard');
});
Route::get('/supervisor/employee/1', function () {
    return view('supervisor/employee-detail');
});

Route::get('/timesheet/1', function () {
    return view('timesheet-detail');
});

Route::get('/profile', function () {
    return view('profile');
});

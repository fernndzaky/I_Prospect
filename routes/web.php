<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorController;

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


//ROUTING FOR ALL USERS THAT NOT YET LOGGED IN
Route::middleware(['guest'])->group(function () {

    //SIGN IN ROUTES
    Route::get('/signin',[LoginController::class, 'index']);
    Route::post('/signin', [LoginController::class, 'authenticate'])->name('signin');

    //SIGN UP ROUTES
    Route::get('/signup',[RegisterController::class, 'index']);
    Route::post('/signup',[RegisterController::class, 'store'])->name('signup');
});


//ROUTING FOR ALL USERS THAT ALREADY LOGGED IN
Route::middleware(['auth'])->group(function () {

    Route::post('/signout', [LoginController::class, 'logout'])->name('signout');

    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/profile',[UserController::class, 'index'])->name('user-profile');
    Route::put('/profile',[UserController::class, 'update_profile'])->name('update-profile');

});

//ROUTING FOR ALL SUPERVISORS
Route::middleware(['isSupervisor'])->group(function () {

    Route::post('/dashboard/add-employee', [SupervisorController::class, 'addEmployee'])->name('add-employee');


});



Route::get('/supervisor/employee/1', function () {
    return view('supervisor/employee-detail');
});

Route::get('/timesheet/1', function () {
    return view('timesheet-detail');
});


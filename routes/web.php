<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\InternFreelancerController;
use App\Http\Controllers\TimesheetController;

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


Route::get('/',[HomeController::class, 'redirect']);

//ROUTING FOR ALL USERS THAT NOT YET LOGGED IN
Route::middleware(['guest'])->group(function () {

    //SIGN IN ROUTES
    Route::get('/forget-password',[LoginController::class, 'forgetPassword']);
    Route::get('/signin',[LoginController::class, 'index'])->name('login');
    Route::post('/signin', [LoginController::class, 'authenticate'])->name('signin');

    //SIGN UP ROUTES
    Route::get('/signup',[RegisterController::class, 'index']);
    Route::post('/signup',[RegisterController::class, 'store'])->name('signup');
    Route::post('/forget-password',[LoginController::class, 'sendNewPassword'])->name('forget-password');

});


//ROUTING FOR ALL USERS THAT ALREADY LOGGED IN
Route::middleware(['auth'])->group(function () {

    Route::post('/signout', [LoginController::class, 'logout'])->name('signout');

    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/profile',[UserController::class, 'index'])->name('user-profile');
    Route::put('/profile',[UserController::class, 'update_profile'])->name('update-profile');
    
    Route::get('/timesheet/{timesheet_id}',[TimesheetController::class, 'index'])->name('timesheet-detail');
    Route::put('/timesheet/update-status', [SupervisorController::class, 'updateTimeSheetStatus'])->name('update-timesheet-status');

    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');

});

//ROUTING FOR ALL INTERNS OR FREELANCER
Route::middleware(['isInternOrFreelancer'])->group(function () {
    Route::get('/timesheet/update/{timesheet_id}', [InternFreelancerController::class, 'edit'])->name('edit-timesheet');
    Route::get('/dashboard/create-timesheet', [InternFreelancerController::class, 'create'])->name('create-timesheet');
    Route::post('/dashboard/create-timesheet', [InternFreelancerController::class, 'store'])->name('store-timesheet');
});

//ROUTING FOR ALL SUPERVISORS
Route::middleware(['isSupervisor'])->group(function () {
    Route::get('/employee/{employee_id}', [SupervisorController::class, 'employeeTimesheetList'])->name('employee-timesheet-list');
    Route::delete('/dashboard/{employee_id}', [SupervisorController::class, 'removeEmployee'])->name('remove-employee');
    Route::post('/dashboard/add-employee', [SupervisorController::class, 'addEmployee'])->name('add-employee');
});







Route::get('/email/timesheetSubmission', function () {
    return view('emails/timesheetSubmission');
});
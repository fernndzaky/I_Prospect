<?php

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
    return view('auth/signin');
});
Route::get('/signup', function () {
    return view('auth/signup');
});


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

<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;



use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        //if supervisor
        if(Auth::user()->user_type_id == 1){
            //get all employee
            $users = User::where('user_type_id',2)->get();

            //get all supervised employees
            $supervised_employees = Auth::user()->employees;

            return view('supervisor/dashboard', compact('users', 'supervised_employees'));
        }
        //if intern or freelancer
        else{
            return view('intern-freelancer/dashboard');
        }

    }


}

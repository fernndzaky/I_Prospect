<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function addEmployee(Request $request){
        //if the selected employee has no supervisor
        if (!auth()->user()->employees->contains($request->employee_id)) {
            //attach intern or freelancer to supervisor
            auth()->user()->employees()->attach($request->employee_id);
            return redirect('/dashboard#new-employee')->with('attachSuccess', 'The employee has been assigned!')->withInput();;
        }
        
        // if the selected employee already has a supervisor
        return redirect('/dashboard#new-employee')->with('attachError', '*The employee already has a supervisor')->withInput();;
    }
}

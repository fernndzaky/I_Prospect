<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Timesheet;
use App\Models\User;


class SupervisorController extends Controller
{

    public function addEmployee(Request $request){

        //if the selected employee has no supervisor
        if(!Helper::isEmployeeSupervised($request->employee_id)){

            //attach intern or freelancer to supervisor
            auth()->user()->employees()->attach($request->employee_id);
            return redirect('/dashboard#new-employee')->with('attachSuccess', 'The employee has been assigned!')->withInput();;
        }
        
        // if the selected employee already has a supervisor
        return redirect('/dashboard#new-employee')->with('attachError', '*The employee already has a supervisor')->withInput();;
    }

    //remove intern or freelancer from supervision list
    public function removeEmployee($employee_id){
        auth()->user()->employees()->detach($employee_id);
        return back()->with('removeSuccecss', 'The employee has been removed from your list.');
    }

    public function employeeTimesheetList($employee_id){

        //get user's timesheets
        $timesheets = Timesheet::where('user_id',$employee_id)
        ->where('time_sheet_status','!=','In Progress')
        ->orderBy('end_date','DESC')
        ->get();


        //get user detail
        $user = User::findOrFail($employee_id);
        return view('supervisor/employee-detail', compact('timesheets','user'));
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateTimesheetStatusMail;



class SupervisorController extends Controller
{

    public function addEmployee(Request $request){

        //if the selected employee has no supervisor
        if(!Helper::isEmployeeSupervised($request->employee_id)){

            //attach intern or freelancer to supervisor
            $user_name = User::where('id', $request->employee_id)->value('name');
            auth()->user()->employees()->attach($request->employee_id,['user_name' => $user_name]);
            return redirect('/dashboard#new-employee')->with('attachSuccess', 'The employee has been assigned!')->withInput();;
        }
        
        // if the selected employee already has a supervisor
        return redirect('/dashboard#new-employee')->with('attachError', '*The employee already has a supervisor')->withInput();;
    }

    //remove intern or freelancer from supervision list
    public function removeEmployee($employee_id){
        auth()->user()->employees()->detach($employee_id);

        //get all supervised timesheets
        $timesheets = Timesheet::where('user_id',$employee_id)->get();
        foreach($timesheets as $timesheet){
            if($timesheet->time_sheet_status == 'Waiting for Approval'){
                $temp_timesheet = Timesheet::findOrFail($timesheet->id);
                $temp_timesheet->time_sheet_status = 'Rejected';
                $temp_timesheet->signed_by = auth()->user()->name;
                $temp_timesheet->save();
            }
        }
        return back()->with('removeSuccecss', 'The employee has been removed from your list.');
    }

    public function employeeTimesheetList($employee_id){

        //get user's timesheets
        $timesheets = Timesheet::where('user_id',$employee_id)
        ->where('time_sheet_status','!=','In Progress')
        ->orderBy('end_date','DESC')
        ->paginate(5);


        //get user detail
        $user = User::findOrFail($employee_id);
        return view('supervisor/employee-detail', compact('timesheets','user'));
    }

    public function updateTimeSheetStatus(Request $request){
        $timesheet = Timesheet::findOrFail($request->timesheet_id);
        $timesheet->time_sheet_status = $request->update_type;
        
        if($request->update_type == 'In Progress'){
            $timesheet->save();
            return redirect('/timesheet/update/'.$request->timesheet_id);
        }
        else{
            $timesheet->signed_by = auth()->user()->name;
            $timesheet->save();
            $timesheet_link = route('timesheet-detail', $timesheet->id);

            Mail::to($timesheet->user->email)->send(new UpdateTimesheetStatusMail($timesheet_link,$request->update_type));

        }
        return redirect()->back();

    }
    
}

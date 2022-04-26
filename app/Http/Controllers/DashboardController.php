<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Timesheet;
use App\Helper\Helper;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        //if supervisor
        if(Auth::user()->user_type_id == 1){
            //get all employee
            $users = User::where('user_type_id',2)->get();

            $employees = Auth::user()->employees;

            //update all timesheet status
            foreach($employees as $employee){
                Helper::updateAssignEmployeeStatus(auth()->user()->id, $employee->id);
            }
            
            //get all supervised employees
            $supervised_employees = DB::table('assigned_employees')
                ->where('user_id', auth()->user()->id)
                ->paginate(5);
                
            return view('supervisor/dashboard', compact('users', 'supervised_employees'));
        }
        //if human resource department
        elseif(Auth::user()->user_type_id == 3){
            //get all supervised employees
            $supervised_employees = DB::table('assigned_employees')
            ->paginate(5)
            ->unique('supervised_id');
            
            //update all timesheet status
            Helper::updateAllTimesheetStatus();

            return view('supervisor/dashboard', compact('supervised_employees'));
            
        }
        //if intern or freelancer
        else{
            $timesheets = Timesheet::where('user_id',auth()->user()->id)->orderBy('end_date','DESC');
            if ($request->has('filter')) {
 
    
                $filter = $request->filter;
                if($filter != 'all')
                    $timesheets = $timesheets->where('time_sheet_status',$filter);
            }
            $timesheets = $timesheets->paginate(5);
            return view('intern-freelancer/dashboard', compact('timesheets'));
        }

    }


}

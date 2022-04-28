<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Exception;
use App\Models\Timesheet;
use App\Models\User;



class Helper
{
    
    public static function storeImage($image, $destinationPath) {
        $ext = strtolower($image->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }

        if ($ext == 'jpg' || $ext == 'jpeg') {
            $img_created = ImageManager::make($image->getRealpath());
            $img_created->orientate();
            $img_created->save($destinationPath.$newName, 75);
        } else {
            $image->move($destinationPath, $newName);
        }

        return $destinationPath.$newName;
    }

    public static function storeFile($file, $destinationPath) {
        $ext = strtolower($file->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }
        
        $file->move($destinationPath, $newName);

        return $destinationPath.$newName;
    }

    // Method to check if an employee has a supervisor.
    public static function isEmployeeSupervised($employee_id) {
        return DB::table('assigned_employees')
            ->where('supervised_id', $employee_id)
            ->count() > 0;
    }

    // Method to check if specific employee is being supervised by specific supervisor.
    public static function isEmployeeSupervisedByMe($supervisor_id, $employee_id) {
        return DB::table('assigned_employees')
            ->where('user_id', $supervisor_id)
            ->where('supervised_id', $employee_id)
            ->count() > 0;
    }

    public static function updateAssignEmployeeStatus($supervisor_id, $employee_id){
        $assigned_employee = DB::table('assigned_employees')
        ->where('user_id', $supervisor_id)
        ->where('supervised_id', $employee_id);
        
        
        $isNeedApproval = Timesheet::where('user_id', $employee_id)
        ->where('time_sheet_status', 'Waiting for Approval')->count() > 0;
        
        if($isNeedApproval){
            $assigned_employee->update(['status' => 'Need Approval']);
        }
        else{
            $assigned_employee->update(['status' => 'Completed']);
            
        }
    }

    public static function updateAllTimesheetStatus(){
        
        //get all employee
        $users = User::where('user_type_id',2)->get();
        
        foreach($users as $user){
            //get employee's supervisor 
            $supervisor_id = DB::table('assigned_employees')
            ->where('supervised_id', $user->id)
            ->first();
            
            if($supervisor_id){
                $supervisor = User::findOrFail($supervisor_id->user_id);
                
                Helper::updateAssignEmployeeStatus($supervisor->id , $user->id);
            }
            
        }
    }

}
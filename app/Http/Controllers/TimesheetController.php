<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Helper\Helper;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($timesheet_id)
    {

        $timesheet = Timesheet::findOrFail($timesheet_id);
        //if supervisor, check whether the timesheet belongs to the supervisor
        if(auth()->user()->user_type_id == 1){
            if(Helper::isEmployeeSupervisedByMe(auth()->user()->id,$timesheet->user_id)){
                return view('timesheet-detail', compact('timesheet'));
            //if the employee is not supervised by the user, redirect to dashboard
            }else{
                return redirect('/dashboard');
            }
        }

        $isEmployeeSupervised = Helper::isEmployeeSupervised(auth()->user()->id);

        //if employee accesing the detail page
        return view('timesheet-detail', compact('timesheet','isEmployeeSupervised'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

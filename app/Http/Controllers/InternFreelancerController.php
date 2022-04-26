<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Models\TimesheetDetail;
use App\Helper\Helper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Mail\TimesheetNotificationMail;

class InternFreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intern-freelancer/create-timesheet');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'work_type_id' => 'required|array|min:1',
            'work_description' => 'required|array|min:1',
            'workinghours' => 'required|array|min:1',
            'total_working_hours' => 'required'
        ]);

        if($request->submission_type == 'submit' || $request->submission_type == 'submit_from_draft'){
            $time_sheet_status = 'Waiting for Approval';
            $message =  'Timesheet sucessfully submitted!';
        }
        else{
            $time_sheet_status = 'In Progress';
            $message =  'Timesheet sucessfully saved as draft!';
        }



        //START STEPS FOR TIMESHEET MODEL //
        //if updating or submitting a draft time sheet
        if($request->submission_type == 'update'  || $request->submission_type == 'submit_from_draft' ){
            $timesheet = Timesheet::findOrFail($request->timesheet_id);
        }
        //if creating a new time sheet
        else{
            $timesheet                      = new Timesheet;
            $timesheet->user_id             = Auth::user()->id;
        }

        $timesheet->start_date          = $validated['start_date'];
        $timesheet->end_date            = $validated['end_date'];
        $timesheet->total_working_hours = $validated['total_working_hours'];
        $timesheet->time_sheet_status   = $time_sheet_status;
        $timesheet->save();
        //END STEPS FOR TIMESHEET MODEL //



        //START STEPS FOR TIMESHEET DETAIL MODEL //
        //if the action is update or submittinng an in progress timesheet
        if($request->submission_type == 'update' || $request->submission_type == 'submit_from_draft' ){
            
            //get all existing time sheet
            $existing_timesheet_details = TimesheetDetail::where('timesheet_id',$timesheet->id)->get();
            
            
            //check apakah ada timesheet detail lama yang dihapus
            foreach($existing_timesheet_details as $key){
                //kalau misalkan semua yang lama dihapus
                if($request->timesheet_detail_ids == null){
                    TimesheetDetail::where('id',$key->id)->delete();
                }
                //kalau misalkan masih ada sisa
                else{
                    //kalo existing timesheet detail gak ada di request terbaru, delete existing time sheet
                    if(!in_array($key->id,$request->timesheet_detail_ids)){
                        TimesheetDetail::where('id',$key->id)->delete();
                    }
                }
            }

            if($request->timesheet_detail_ids == null){
                $starting_index = 0;
            }
            else{
                $starting_index = count($request->timesheet_detail_ids);
            }

            //buat timesheet detail baru yang baru disubmit
            for ($i=$starting_index; $i < count($request->work_type_id); $i++) {
                $new_timesheet_detail                   = new TimesheetDetail;
                $new_timesheet_detail->timesheet_id     = $timesheet->id;
                $new_timesheet_detail->work_type_id     = $validated['work_type_id'][$i];
                $new_timesheet_detail->work_description = $validated['work_description'][$i];
                $new_timesheet_detail->workinghours     = $validated['workinghours'][$i];
                //for attachements
                if($request->has('attachment'))
                    if(array_key_exists($i, $request->file('attachment')))
                        $new_timesheet_detail->attachment       = Helper::storeImage($request->file('attachment')[$i], 'storage/images/timesheets/');
                
                $new_timesheet_detail->save();
            }  

            //update yg lama (kalau masih ada yang lama)
            if($request->timesheet_detail_ids != null){
                for($j=0;$j < count($request->timesheet_detail_ids);$j++){
                    
                    $old_timesheet_detail = TimesheetDetail::findOrFail($request->timesheet_detail_ids[$j]);
                    $old_timesheet_detail->work_type_id             = $request->work_type_id[$j];
                    $old_timesheet_detail->work_description         = $request->work_description[$j];
                    $old_timesheet_detail->workinghours             = $request->workinghours[$j];
                    if($request->has('attachment'))
                        if(array_key_exists($j, $request->file('attachment')))
                            $old_timesheet_detail->attachment       = Helper::storeImage($request->file('attachment')[$j], 'storage/images/timesheets/');
                    $old_timesheet_detail->save();
                }
            }

        }

        //if the action is submit (not from draft)
        else{

            for ($i=0; $i < count($request->work_type_id); $i++) {      
                $timesheet_detail                   = new TimesheetDetail;
                $timesheet_detail->timesheet_id     = $timesheet->id;
                $timesheet_detail->work_type_id     = $validated['work_type_id'][$i];
                $timesheet_detail->work_description = $validated['work_description'][$i];
                $timesheet_detail->workinghours     = $validated['workinghours'][$i];
                //for attachements
                if($request->has('attachment'))
                    if(array_key_exists($i, $request->file('attachment')))
                        $timesheet_detail->attachment       = Helper::storeImage($request->file('attachment')[$i], 'storage/images/timesheets/');
                
                $timesheet_detail->save();
            }
        }
        //END STEPS FOR TIMESHEET DETAIL MODEL //

        //email to supervisor if submit a timesheet
        if($request->submission_type == 'submit' || $request->submission_type == 'submit_from_draft'){

            //get the supervisor
            $supervisor_id = DB::table('assigned_employees')
            ->where('supervised_id', auth()->user()->id)
            ->first()->user_id;

            $supervisor = User::findOrFail($supervisor_id);
            $timesheet_link = route('timesheet-detail', $timesheet->id);

            Mail::to($supervisor->email)->send(new TimesheetNotificationMail($timesheet_link, auth()->user()->name));


        }

        return redirect('/dashboard')->with('createSuccess',$message);

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
        $timesheet = Timesheet::findOrFail($id);
        return view('intern-freelancer/update-timesheet', compact('timesheet'));

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

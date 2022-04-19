@extends('layout')

@section('title', 'IProspect Timesheet Detail')


@section('container')

<div class="row m-0 page-container" style="padding-bottom:8vw">

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style=";margin-top:4vw;">
            <a href="/dashboard" class="px-24" style="text-decoration:none;color:#3D5BC6"><- Back</a>
        </div>
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Timesheet</p>
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Status : 
            @if($timesheet->time_sheet_status == 'Waiting for Approval')
                <span style="color:#FF9901;margin-left:1vw">{{$timesheet->time_sheet_status}}</span>
            @elseif($timesheet->time_sheet_status == 'In Progress')
                <span style="color:#FF9901;margin-left:1vw">{{$timesheet->time_sheet_status}}</span>
            @elseif($timesheet->time_sheet_status == 'Approved')
                <span style="color:#3A8D1C;margin-left:1vw">{{$timesheet->time_sheet_status}}</span>
            @else
                <span style="color:#FF0101;margin-left:1vw">{{$timesheet->time_sheet_status}}</span>
            @endif
        </p>
            <p class="btn-grey px-24"style="width:auto;text-align:center;font-weight:bold;padding-left:2vw;padding-right:2vw;margin-bottom:0px">{{$timesheet->user->name}}</p>
    
        </div>
    </div>
    <!-- END OF HEADER -->
    
    <!-- START OF TIMESHEET DETAIL -->
    <div class="col-12" style="padding:0vw 5vw">
        <!-- START OF DATE -->
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div style="display:flex;justify-content:space-between;">
                <div>
                    <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Start Date</p>
                    <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">{{date('d M Y', strtotime($timesheet->start_date))}}</p>
                </div>
                <div>
                    <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">End Date</p>
                    <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">{{date('d M Y', strtotime($timesheet->end_date))}}</p>
                </div>
            </div>
        </div>
        <!-- END OF DATE -->
        
        <!-- START OF ONE WORK DETAIL -->
        @foreach($timesheet->timesheetDetails as $timesheet_detail)
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div>
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Type</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">{{$timesheet_detail->workType->type}}</p>
            </div>
            <div style="margin-top:2vw">
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Description</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px;;white-space:pre-line">{{$timesheet_detail->work_description}}</p>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:2vw;align-items:center">
                <div>
                    @if($timesheet_detail->attachment)
                    <a href="/{{$timesheet_detail->attachment}}" download class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See attached file</a>
                    @endif
                </div>
                <div>
                    <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Work Hours: <span style="font-weight:bold" class="px-24">{{$timesheet_detail->workinghours}}</span></p>
                </div>
            </div>
        </div>
        <!-- END OF ONE WORK DETAIL -->
        @endforeach

        <!-- START OF TOTAL WORKING HOUR -->
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div style="text-align:right">
                <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Total Working Hours: <span style="font-weight:bold" class="px-24">{{$timesheet->total_working_hours}}</span></p>
            </div>
        </div>
        <!-- END OF TOTAL WORKING HOUR -->

        <!-- IF SUPERVISOR -->
        @if(auth()->user()->user_type_id == 1)
        <!-- START OF ACCEPT REJECT SUPERVISOR -->
        <div style="display:flex;justify-content:center;margin-top:2vw">
            <button class="btn-green px-24" type="submit" style="margin-right:2vw">Approve</button>
            <button class="btn-red px-24" type="submit" style="margin-left:2vw" >Reject</button>
        </div>
        @endif
        <!-- END OF ACCEPT REJECT SUPERVISOR -->
        <!-- END FOR SUPERVISOR -->

    </div>
    <!-- END OF TIMESHEET DETAIL -->
</div>

@endsection

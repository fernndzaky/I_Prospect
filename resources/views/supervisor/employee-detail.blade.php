@extends('layout')

@section('title', 'IProspect Timesheet Supervisor Approval')


@section('container')

<div class="row m-0 page-container" style="padding-bottom:8vw">

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style=";margin-top:4vw;">
            <a href="/dashboard" class="px-24" style="text-decoration:none;color:#3D5BC6"><- Back</a>
        </div>
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Timesheet</p>
            <p class="btn-grey px-24"style="width:auto;text-align:center;font-weight:bold;padding-left:2vw;padding-right:2vw;margin-bottom:0px">{{$user->name}}</p>
    
        </div>
    </div>
    <!-- END OF HEADER -->
    
    <!-- START OF TABLE -->
    <div class="col-12 p-0">
        <table class="table" style="padding:1vw 2vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <thead>
                <tr>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:40%">Date</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:30%">Status</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:30%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timesheets as $timesheet)
                <!-- START OF ONE ROW -->
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">{{date('d M Y', strtotime($timesheet->start_date))}}  - {{date('d M Y', strtotime($timesheet->end_date))}}</p>
                    </td>
                    <td class="ps-0">
                        @if($timesheet->time_sheet_status == 'Waiting for Approval')
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF9901">{{$timesheet->time_sheet_status}}</p>
                        @elseif($timesheet->time_sheet_status == 'In Progress')
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF9901">{{$timesheet->time_sheet_status}}</p>
                        @elseif($timesheet->time_sheet_status == 'Approved')
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#3A8D1C">{{$timesheet->time_sheet_status}}</p>
                        @else
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF0101">{{$timesheet->time_sheet_status}}</p>
                        @endif
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;">
                            <a href="/timesheet/{{$timesheet->id}}" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Detail</a>
                        </div>
                    </td>
                </tr>
                <!-- END OF ONE ROW -->
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END OF TABLE -->
    
    <!-- START OF PAGINATION -->
    <div class="col-md-12 d-flex justify-content-center px-18">
            {{$timesheets->links('pagination::bootstrap-4')}}
    </div>
    <!-- END OF PAGINATION -->

    <!-- IF THERE IS NO SUPERVISED EMPLOYEES -->
    @if(!count($timesheets))
        <div style="text-align:center">
            <p class="px-24" style="margin-bottom:0.5vw">This employee have not submiited any timesheet..</p>
        </div>
        @endif
</div>

@endsection

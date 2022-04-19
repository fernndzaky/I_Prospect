@extends('layout')

@section('title', 'IProspect Timesheet Dashboard')


@section('container')
<div class="row m-0 page-container" style="padding-bottom:8vw" >

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:4vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Timesheet</p>
            <a href="{{route('create-timesheet')}}" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Add New</a>
    
        </div>
    </div>
    <!-- END OF HEADER -->

    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
        </div>
        
    <!-- START OF TABLE -->
    <div class="col-12 p-0" style="margin-top:2vw;">
        @if(session()->has('createSuccess'))
        <div style="text-align:center;padding-bottom:1vw">
            <p class="px-24" style="color:green">{{session('createSuccess')}}</p>
        </div>
        @endif
        <div class="dataTables_length" id="show_entries" style="margin-bottom:1vw">
            <p class="px-24 mb-0">Filter By:</p>
            <select aria-controls="dataTable" class="px-18" onchange="if (this.value) window.location.href=this.value">
                <option value=""  selected disabled>Please choose filter</option>
                <option value="{{ request()->fullUrlWithQuery(['filter' => 'all']) }}" @if (Request::get('filter') == 'all') selected @endif>Show All</option>
                <option value="{{ request()->fullUrlWithQuery(['filter' => 'waitingForApproval']) }}" @if (Request::get('filter') == 'waitingForApproval') selected @endif>Waiting For Approval</option>
                <option value="{{ request()->fullUrlWithQuery(['filter' => 'inProgress']) }}" @if (Request::get('filter') == 'inProgress') selected @endif>In Progress</option>
                <option value="{{ request()->fullUrlWithQuery(['filter' => 'approved']) }}" @if (Request::get('filter') == 'approved') selected @endif>Approved</option>
                <option value="{{ request()->fullUrlWithQuery(['filter' => 'rejected']) }}" @if (Request::get('filter') == 'rejected') selected @endif>Rejected</option>
            </select>
        </div>
        <table class="table" style="padding:1vw 2vw;background:#F1F1F1;border-radius:1vw;">
            <thead>
                <tr>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:40%">Date</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:30%">Status</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;width:30%">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- START OF ONE TIME SHEET -->
                @foreach(auth()->user()->timesheets as $timesheet)
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">{{date('d-M-Y', strtotime($timesheet->start_date))}} - {{date('d-M-Y', strtotime($timesheet->end_date))}}</p>
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
                            @if($timesheet->time_sheet_status == 'In Progress')
                            <a href="/timesheet/update/{{$timesheet->id}}" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Detail</a>
                            @else
                            <a href="/timesheet/{{$timesheet->id}}" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Detail</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- END OF ONE TIME SHEET -->
            </tbody>
        </table>
        <!-- IF THERE IS NO SUPERVISED EMPLOYEES -->
        @if(!count(auth()->user()->timesheets))
        <div style="text-align:center">
            <p class="px-24" style="margin-bottom:0.5vw">You have no timesheets record..</p>
        </div>
        @endif
    </div>
    <!-- END OF TABLE -->
</div>

@endsection

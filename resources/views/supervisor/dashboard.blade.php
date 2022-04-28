@extends('layout')

@section('title', 'IProspect Timesheet Dashboard')


@section('container')
@if(auth()->user()->user_type_id == 1)
<!-- START OF POPUP ADD NEW SUPERVISED EMPLOYEE -->
<div id="new-employee" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:30% ">
        <!--<a class="close" href="#" >&times;</a>-->
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12">
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >New Supervised Employee</p>
                    <!-- START OF FORM -->
                    <form action="{{route('add-employee')}}" method="post" style="margin-top:2vw">
                    @csrf
                        <select class="px-24" name="employee_id" style="width:100%;padding:0.5vw">
                            <option value="" disabled selected>Please select an employee</option>
                            @foreach($users as $user)

                            <option value="{{$user->id}}"
                            @if(old('employee_id') == $user->id) selected @endif
                            >{{$user->name}}</option>

                            @endforeach
                        </select>
                        <div style="text-align:center">

                            @if(session()->has('attachError'))
                            <div style="text-align:center">
                                <strong class="px-18" style="color:red">{{session('attachError')}}</strong>
                            </div>
                            @enderror
                            @if(session()->has('attachSuccess'))
                            <div style="text-align:center">
                                <strong class="px-18" style="color:green">{{session('attachSuccess')}}</strong>
                            </div>
                            @enderror

                            <button class="btn-grey px-24" type="submit" style="margin-top:2vw;padding-left:2vw;padding-right:2vw;margin-bottom:1vw">Confirm</button>
                            <br>
                            <a href="#" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Cancel</a>
                        </div>
                    </form>

                    <!-- END OF FORM -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP ADD NEW SUPERVISED EMPLOYEE -->
@endif

<div class="row m-0 page-container" style="padding-bottom:8vw" >

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:4vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >
            @if(auth()->user()->user_type_id == 1)
            List of Supervision
            @else
            List of Employees
            @endif
        </p>
        @if(auth()->user()->user_type_id == 1)
        <a href="#new-employee" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Add New</a>
        @endif
    
        </div>
    </div>
    <!-- END OF HEADER -->
    
    <!-- START OF TABLE -->
    <div class="col-12 p-0" style=";margin-top:2vw;">
        @if(session()->has('removeSuccecss'))
        <div style="text-align:center;padding-bottom:1vw">
            <p class="px-24" style="color:green">{{session('removeSuccecss')}}</p>
        </div>
        @endif

        @if(auth()->user()->user_type_id == 3)

        <form action="" method="GET" style="margin-bottom:1vw">
            <input name="search" value="{{ Request::get('search') }}" type="search" class="px-24" 
                                style="width:30%;padding:0vw 0.4vw"  placeholder="Search an employee" aria-controls="dataTable">
        </form>
        @endif
        <table class="table" style="padding:1vw 2vw;background:#F1F1F1;border-radius:1vw;">
            <thead>
                <tr>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;">Name</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;">Status</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;text-align:center;width:40%">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- START OF EMPLOYEE LIST -->
                @foreach($supervised_employees as $employee)
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">{{$employee->user_name}}</p>
                    </td>
                    <td class="ps-0">
                        @if($employee->status == 'Need Approval')
                            <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF0101">{{$employee->status}}</p>
                        @else
                            <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#3A8D1C">{{$employee->status}}</p>
                        @endif
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;display:flex;justify-content:space-between">
                            <a href="/employee/{{$employee->supervised_id}}" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Timesheet List</a>
                            @if(auth()->user()->user_type_id == 1)
                            <form action="{{ route('remove-employee', $employee->supervised_id) }}" method="post">
                            @csrf
                            @method('delete')
                                <button onclick="return confirm('Are you sure you want to remove this employee from your list?')" type="submit" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#FF0101;padding:0.5vw 1vw">Remove from list</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- END OF EMPLOYEE LIST -->
            </tbody>
        </table>

        <!-- START OF PAGINATION -->
        @if(auth()->user()->user_type_id == 1)
        <div class="col-md-12 d-flex justify-content-center px-18">
            {{$supervised_employees->links('pagination::bootstrap-4')}}
        </div>
        @endif
        <!-- END OF PAGINATION -->

        <!-- IF THERE IS NO SUPERVISED EMPLOYEES -->
        @if(!count($supervised_employees))
        <div style="text-align:center">
            <p class="px-24" style="margin-bottom:0.5vw">You have no employee to be supervised..</p>
        </div>
        @endif
    </div>
    <!-- END OF TABLE -->
</div>

@endsection

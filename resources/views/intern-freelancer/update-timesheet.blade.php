@extends('layout')

@section('title', 'IProspect Timesheet Update')


@section('container')
<form action="{{ route('store-timesheet') }}" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" name="timesheet_id" value="{{$timesheet->id}}">
    <div class="row m-0 page-container" style="padding-bottom:8vw">

        <!-- START OF HEADER -->
        <div class="col-12 p-0">
            <div style=";margin-top:4vw;">
                <a href="/dashboard" class="px-24" style="text-decoration:none;color:#3D5BC6"><- Back</a>
            </div>
            <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
                <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Timesheet</p>
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
                        <input type="date" name="start_date" value="{{$timesheet->start_date}}" class="px-18" style="width:15vw" required>
                        @error('start_date')
                        <br>
                        <strong class="px-18" style="color:red">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div>
                        <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">End Date</p>
                        <input type="date" name="end_date" value="{{$timesheet->end_date}}" class="px-18" style="width:15vw" required>
                        @error('end_date')
                        <br>
                        <strong class="px-18" style="color:red">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- END OF DATE -->

            <div id="timesheet_detail_duplicator_wrapper">

                <!-- START OF ONE WORK DETAIL -->
                <!-- THIS DIV IS ONLY FOR DUPLICATOR -->
                <div id="timesheet_detail_duplicator" style="display:none">
                    
                    <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
                        <div style="text-align:right">
                            <button type="button" onClick="removeDiv(this, 'timesheet_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="px-36" ><i class="fas fa-times-circle"></i></button>
                        </div>
                        <div>
                            <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Type</p>
                            <select class="px-18" id="work_type"
                            style="width:100%;padding:0.5vw">
                                <option disabled selected>Please choose work type</option>
                                @foreach($work_types as $work_type)
                                <option value="{{$work_type->id}}">{{$work_type->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-top:2vw">
                            <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Description</p>
                            <textarea  id="work_description" 
                            style="width:100%;padding:0.5vw"rows="4"></textarea>
                        </div>
                        
                        <div style="display:flex;justify-content:space-between;margin-top:2vw;align-items:center">
                            <div>
                                <input id="attachment" accept=".jpeg,.jpg,.png,application/pdf" type="file">
                            </div>
                            <div>
                                <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Work Hours:
                                    <span class="px-24">
                                        <input type="text" style="width:3vw;text-align:center" id="workhours">
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- END OF ONE WORK DETAIL -->

                @foreach($timesheet->timesheetDetails as $timesheetDetail)
                <!-- START OF ONE WORK DETAIL -->
                <div id="timesheet_detail_duplicator1" >
                    <input type="hidden" name="timesheet_detail_ids[]" value="{{$timesheetDetail->id}}">
                    <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
                        <div style="text-align:right">
                            <button type="button" onClick="removeDiv(this, 'timesheet_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="px-36" ><i class="fas fa-times-circle"></i></button>
                        </div>
                        <div>
                            <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Type </p>
                            <select name="work_type_id[]" class="px-18" id="work_type"
                            style="width:100%;padding:0.5vw" required>
                                <option value="" disabled>Please choose work type</option>
                                @foreach($work_types as $work_type)
                                <option @if($timesheetDetail->work_type_id == $work_type->id) selected @endif value="{{$work_type->id}}">{{$work_type->type}}</option>
                                @endforeach
                            </select>
                            @error('work_type')
                                <strong class="px-18" style="color:red">{{ $message }}</strong>
                            @enderror   

                        </div>

                        <div style="margin-top:2vw">
                            <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Description</p>
                            <textarea name="work_description[]" id="work_description" 
                            style="width:100%;padding:0.5vw"rows="4" >{{$timesheetDetail->work_description}}</textarea>
                            @error('work_description')
                                <strong class="px-18" style="color:red">{{ $message }}</strong>
                            @enderror  
                        </div>
                        
                        <div style="display:flex;justify-content:space-between;margin-top:2vw;align-items:center">
                            <div>
                                <div>
                                    @if($timesheetDetail->attachment)
                                        <a href="/{{$timesheetDetail->attachment}}" download class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See attached file</a> <br> <br>
                                    @endif
                                    <input id="attachment" name="attachment[]" accept=".jpeg,.jpg,.png,application/pdf" type="file">

                                </div>
                                @error('attachment')
                                    <br>
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror  
                            </div>
                            <div>
                                <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Work Hours:
                                    <span class="px-24">
                                        <input type="text" style="width:3vw;text-align:center" value="{{$timesheetDetail->workinghours}}" required name="workinghours[]" id="workhours">
                                        @error('workhours')
                                            <br>
                                            <strong class="px-18" style="color:red">{{ $message }}</strong>
                                        @enderror  
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END OF ONE WORK DETAIL -->
                @endforeach
                
            </div>
            <div style="text-align:center;margin-top:2vw">

                <a class="btn-green px-24" id="add_timesheet_detail" onlick="duplicateRequirement()" style="text-decoration:none;cursor:pointer" >Add Task</a>
            </div>

            <!-- START OF TOTAL WORKING HOUR -->
            <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:5vw;border-radius:1vw;">
                <div style="text-align:right">
                    <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Total Working Hours: <span class="px-24"><input type="number" style="width:3vw;text-align:center" value="{{$timesheet->total_working_hours}}" name="total_working_hours" id="total_working_hours" required></span></p>
                    @error('total_working_hours')
                        <br>
                        <strong class="px-18" style="color:red">{{ $message }}</strong>
                    @enderror 
                </div>
            </div>
            <!-- END OF TOTAL WORKING HOUR -->

            <!-- START OF ACCEPT REJECT SUPERVISOR -->
            <div style="display:flex;justify-content:center;margin-top:2vw">
                <button value="update" name="submission_type" class="btn-orange px-24" type="submit" style="margin-right:2vw">Save - In Progress</button>
                <button value="submit_from_draft" name="submission_type" class="btn-grey px-24" type="submit" style="margin-left:2vw" >Submit For Approval</button>

            </div>
            <!-- END OF ACCEPT REJECT SUPERVISOR -->

        </div>
        <!-- END OF TIMESHEET DETAIL -->
    </div>
</form>



<!-- START OF SCRIPT -->
<script>
document.getElementById('add_timesheet_detail').onclick = duplicateRequirement;
var i = 1;
var original = document.getElementById('timesheet_detail_duplicator');
function duplicateRequirement() {
    var clone = original.cloneNode(true); // "deep" clone
    $(clone).find("#work_type").attr("name", "work_type_id[]");
    $(clone).find("#work_type").prop('required',true);
    $(clone).find("#work_description").attr("name", "work_description[]");
    $(clone).find("#work_description").prop('required',true);
    $(clone).find("#workhours").attr("name", "workinghours[]");
    $(clone).find("#workhours").prop('required',true);
    $(clone).find("#attachment").attr("name", "attachment[]");
    clone.style.display = "block";
    clone.id = "timesheet_detail_duplicator" + ++i; // there can only be one element with an ID
    original.parentNode.appendChild(clone);
}

function removeDiv(elem, wrapper_id){
    var parent = $(elem).parent('div').parent('div').parent('div');
    console.log(document.getElementById(wrapper_id).childElementCount)
    if (document.getElementById(wrapper_id).childElementCount > 2) {
        parent.remove();
    } else {
        alert("At least one element must be present!");
    }
}
</script>
<!-- END OF SCRIPT -->

@endsection

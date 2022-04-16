@extends('layout')

@section('title', 'IProspect Timesheet Dashboard')


@section('container')
<!-- START OF POPUP ADD NEW SUPERVISED EMPLOYEE -->
<div id="new-employee" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:30% ">
        <!--<a class="close" href="#" >&times;</a>-->
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12">
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >New Supervised Employee</p>
                    <!-- START OF FORM -->
                    <form action="" style="margin-top:2vw">
                        <select class="px-24" name="" id="" style="width:100%;padding:0.5vw">
                            <option value="" disabled selected>Please select an employee</option>
                            <option value="">Athallah</option>
                        </select>
                        <div style="text-align:center">
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

<div class="row m-0 page-container" style="padding-bottom:8vw" >

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:4vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >List of Supervision</p>
            <a href="#new-employee" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Add New</a>
    
        </div>
    </div>
    <!-- END OF HEADER -->
    
    <!-- START OF TABLE -->
    <div class="col-12 p-0">
        <table class="table" style="padding:1vw 2vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <thead>
                <tr>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;">Name</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;">Status</th>
                    <th scope="col" class="px-36" style="font-weight:bold;color:#92D050;padding:1vw 2vw;text-align:center;width:40%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">Fauzan Athallah Arief</p>
                    </td>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF0101">Need Approval</p>
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;display:flex;justify-content:space-between">
                            <a href="/supervisor/employee/1" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Timesheet Detail</a>
                            <a href="/" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#FF0101;text-decoration:none;padding:0.5vw 1vw">Remove from list</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">Septiano Pratama</p>
                    </td>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#3A8D1C">Complete</p>
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;display:flex;justify-content:space-between">
                            <a href="/supervisor/employee/1" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Timesheet Detail</a>
                            <a href="/" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#FF0101;text-decoration:none;padding:0.5vw 1vw">Remove from list</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END OF TABLE -->
</div>

@endsection

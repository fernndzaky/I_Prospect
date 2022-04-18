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
            <p class="btn-grey px-24"style="width:auto;text-align:center;font-weight:bold;padding-left:2vw;padding-right:2vw;margin-bottom:0px">Fauzan Athallah Arief</p>
    
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
                    <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">31 January 2021</p>
                </div>
                <div>
                    <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">End Date</p>
                    <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">31 January 2021</p>
                </div>
            </div>
        </div>
        <!-- END OF DATE -->
        
        <!-- START OF ONE WORK DETAIL -->
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div>
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Type</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">iProspect Project Work</p>
            </div>
            <div style="margin-top:2vw">
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Description</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">Nestle: Monthly Report January 2022</p>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:2vw;align-items:center">
                <a href="/timesheet/1" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See attached file</a>
                <div>
                    <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Work Hours: <span style="font-weight:bold" class="px-24">4</span></p>

                </div>
            </div>
        </div>
        <!-- END OF ONE WORK DETAIL -->

        <!-- START OF ONE WORK DETAIL -->
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div>
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Type</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">iProspect Project Work</p>
            </div>
            <div style="margin-top:2vw">
                <p class="px-18" style="margin-bottom:0.5vw;color:#3A8D1C;font-weight:bold">Work Description</p>
                <p class="px-18" style="color:#000000;font-weight:bold;margin-bottom:0px">Nestle: Monthly Report January 2022</p>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:2vw;align-items:center">
                <div>
                    <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Work Hours: <span style="font-weight:bold" class="px-24">4</span></p>

                </div>
            </div>
        </div>
        <!-- END OF ONE WORK DETAIL -->

        <!-- START OF TOTAL WORKING HOUR -->
        <div style="padding:1.5vw 5vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;">
            <div style="text-align:right">
                <p class="px-18" style="margin-bottom:0px;color:#3A8D1C;">Total Working Hours: <span style="font-weight:bold" class="px-24">8</span></p>
            </div>
        </div>
        <!-- END OF TOTAL WORKING HOUR -->

        <!-- START OF ACCEPT REJECT SUPERVISOR -->
        <div style="display:flex;justify-content:center;margin-top:2vw">
            <button class="btn-green px-24" type="submit" style="margin-right:2vw">Approve</button>
            <button class="btn-red px-24" type="submit" style="margin-left:2vw" >Reject</button>

        </div>
        <!-- END OF ACCEPT REJECT SUPERVISOR -->

    </div>
    <!-- END OF TIMESHEET DETAIL -->
</div>

@endsection

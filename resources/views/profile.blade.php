@extends('layout')

@section('title', 'IProspect Timesheet Profile')


@section('container')

<div class="row m-0 page-container" style="padding-bottom:8vw">

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style=";margin-top:4vw;">
            <a href="/supervisor" class="px-24" style="text-decoration:none"><- Back</a>
        </div>
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Account Information</p>
            <a href="/" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Update Profile</a>
    
        </div>
    </div>
    <!-- END OF HEADER -->

    <!-- START OF FORM -->
    <div class="col-12 p-0">
        <div style="padding:1vw;background:#F1F1F1;margin-top:4vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <div style="background-color:white;padding:2vw;border-radius:1vw;width:100%;height:100%">
                <div>
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Name</p>
                    <p class="px-24" style="font-weight:bold;color:#000000;margin-bottom:0px" >Bernandy Christian</p>
                </div>
                <div style="margin-top:1.5vw">
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Email</p>
                    <p class="px-24" style="font-weight:bold;color:#000000;margin-bottom:0px" >Bernandy.Christian@iprospect.com</p>
                </div>
                <div style="margin-top:1.5vw">
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Occupancy</p>
                    <p class="px-24" style="font-weight:bold;color:#000000;margin-bottom:0px" >Sr. SEO Specialist</p>
                </div>
                <div style="margin-top:2vw;display:flex;align-items:center">
                    <img src="/assets/User_Icon.png" class="img-fluid" style="max-height:8vw" alt="User_Icon">
                    <div style="margin-left:2vw">
                        <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:1vw" >Profile Picture</p>
                        <a href="/" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Change Picture</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- END OF FORM -->
    
</div>

@endsection

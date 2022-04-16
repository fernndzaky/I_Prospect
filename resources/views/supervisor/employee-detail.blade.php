@extends('layout')

@section('title', 'IProspect Timesheet Supervisor Approval')


@section('container')

<div class="row m-0 page-container" style="padding-bottom:8vw">

    <!-- START OF HEADER -->
    <div class="col-12 p-0">
        <div style=";margin-top:4vw;">
            <a href="/supervisor" class="px-24" style="text-decoration:none"><- Back</a>
        </div>
        <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Timesheet</p>
            <p class="btn-grey px-24"style="width:auto;text-align:center;font-weight:bold;padding-left:2vw;padding-right:2vw;margin-bottom:0px">Fauzan Athallah Arief</p>
    
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
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">1 February 2022 - 11 February 2022</p>
                    </td>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#FF0101">Need Approval</p>
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;">
                            <a href="/timesheet/1" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Detail</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;">12 February 2022 - 20 February 2022</p>
                    </td>
                    <td class="ps-0">
                        <p class="px-18 mb-0" style="font-weight:bold;padding:1vw 2vw;color:#3A8D1C">Complete</p>
                    </td>
                    <td class="ps-0">
                        <div style=";padding:1vw 2vw;">
                            <a href="/timesheet/1" class="px-18" style="font-weight:bold;background-color:#FFFFFF;border:1px solid black;border-radius:2vw;color:#3D5BC6;text-decoration:none;padding:0.5vw 1vw">See Detail</a>
                        </div>                    
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END OF TABLE -->
</div>

@endsection

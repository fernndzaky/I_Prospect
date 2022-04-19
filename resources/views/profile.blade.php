@extends('layout')

@section('title', 'IProspect Timesheet Profile')


@section('container')
<style>

/* START OF CUSTOM INPUT FILE*/
input[type="file"] {
    display: none;
}

.custom-file-upload {
    background-color:#615D5D;
    border:0px;
    padding:0.5vw 1vw;
    border-radius:2vw;
    color:#FFFFFF;
    cursor: pointer;
}

/* END OF CUSTOM INPUT TYPE FILE */
</style>

<!-- START OF FORM -->
<form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
@csrf
@method('put')
    <div class="row m-0 page-container" style="padding-bottom:8vw">

        <!-- START OF HEADER -->
        <div class="col-12 p-0">
            <div style=";margin-top:4vw;">
                <a href="/dashboard" class="px-24" style="text-decoration:none;color:#3D5BC6"><- Back</a>
            </div>
            <div style="padding:1vw 2vw;background:#F1F1F1;margin-top:0.5vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
                <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Account Information</p>
                <button type="submit" class="btn-grey px-24" style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Update Profile</button>
            </div>
        </div>
        <!-- END OF HEADER -->

        <div class="col-12 p-0">
            <div style="padding:1vw;background:#F1F1F1;margin-top:2vw;border-radius:1vw;display:flex;align-items:center;justify-content:space-between">
                <div style="background-color:white;padding:2vw;border-radius:1vw;width:100%;height:100%">
                    <p class="px-24" style="margin-bottom:0.5vw;color:green">{{session('message')}}</p>
                    <div>
                        <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Name</p>
                        <input type="text" name="name" class="px-24" 
                        style="width:50%;padding:0vw 0.4vw" placeholder="Insert your name" required
                        value="{{auth()->user()->name}}">
                        <br>
                        @error('name')
                            <strong class="px-18" style="color:red">{{ $message }}</strong>
                        @enderror
                        <!--<p class="px-24" style="font-weight:bold;color:#000000;margin-bottom:0px" >Bernandy Christian</p>-->
                    </div>
                    <div style="margin-top:1.5vw">
                        <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Email</p>
                        <input type="email" name="email" class="px-24" 
                        style="width:50%;padding:0vw 0.4vw" placeholder="Insert your password" required disabled
                        value="{{auth()->user()->email}}"> 
                        <br>
                        @error('email')
                            <strong class="px-18" style="color:red">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div style="margin-top:1.5vw">
                        <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Occupancy</p>
                        <input type="text" name="occupancy" class="px-24" 
                        style="width:50%;padding:0vw 0.4vw" placeholder="Insert your occupancy" required
                        value="{{auth()->user()->occupancy}}">
                        <br>
                        @error('occupancy')
                            <strong class="px-18" style="color:red">{{ $message }}</strong>
                        @enderror
                    </div>
                            
                    <div style="margin-top:2vw;display:flex;align-items:center">
                        @if(auth()->user()->avatar)
                        <img src="/{{auth()->user()->avatar}}" class="img-fluid" style="max-height:8vw" alt="User Avatar">
                        @else
                        <img src="/assets/User_Icon.png" class="img-fluid" style="max-height:8vw" alt="User Avatar">
                        @endif
                        <div style="margin-left:2vw">
                            <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:1vw" >Profile Picture</p>
                           
                            <label for="file-upload" class="custom-file-upload px-24">
                                <i class="fa fa-cloud-upload"></i> Upload Image
                            </label>
                            <input id="file-upload" accept=".jpeg,.jpg,.png" name='avatar' type="file" style="display:none;">
                            <br>
                            @error('avatar')
                                <strong class="px-18" style="color:red">lorem</strong>
                            @enderror
                        </div>
                    </div>
                    <!-- END OF UPDATE PROFILE -->     
                    
                </div>
            </div>
        </div>
        
    </div>
</form>
<!-- END OF FORM -->


@endsection

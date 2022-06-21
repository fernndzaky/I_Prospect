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

<!-- START OF POPUP ADD NEW SUPERVISED EMPLOYEE -->
<div id="change-password" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:30% ">
        <!--<a class="close" href="#" >&times;</a>-->
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12">
                    <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Change Password</p>
                    <!-- START OF FORM -->
                    <form action="{{route('change-password')}}" method="post" style="margin-top:2vw">
                    @csrf
                        <div style="text-align:center">
                        <input type="password" name="old_password" class="px-24 w-100" style="padding:0vw 0.4vw" placeholder="Insert old password" required>
                        @error('old_password')
                            <span class="invalid-feedback px-18" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="password" class="px-24 w-100" style="padding:0vw 0.4vw;margin-top:1vw" placeholder="Insert new password" required>
                        @error('password')
                            <span class="invalid-feedback px-18" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="password_confirmation" class="px-24 w-100" style="padding:0vw 0.4vw;margin-top:1vw" placeholder="Confirm new password" required>
                        @error('password_confirmation')
                            <span class="invalid-feedback px-18" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
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
                    <div class="row m-0">
                        <div class="col-12 p-0">
                        <p class="px-18" style="font-weight:bold;color:#333333;" >*Please Note: Don't forget to press the update profile button above after you change the name, occupation or upload a picture. Otherwise all of the current changes would not be saved. This is not necessary for change password.</p>

                        </div>
                        <div class="col-md-6 col-xs-12 p-0">
                            <div>
                                <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Name</p>
                                <input type="text" name="name" class="px-24 w-100" 
                                style="width:50%;padding:0vw 0.4vw" placeholder="Insert your name" required
                                value="{{auth()->user()->name}}">
                                <br>
                                @error('name')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 ">
                            <div style="margin-top:2vw;text-align:right">
                                <a href="#change-password" class="btn-grey px-24"style="width:auto;text-align:center;text-decoration:none;padding-left:2vw;padding-right:2vw">Change Password</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 p-0">
                            <div style="margin-top:1.5vw">
                                <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Email</p>
                                <input type="email" name="email" class="px-24 w-100" 
                                style="width:50%;padding:0vw 0.4vw" placeholder="Insert your password" required disabled
                                value="{{auth()->user()->email}}"> 
                                <br>
                                @error('email')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 p-0">

                        </div>
                        <div class="col-md-6 col-xs-12 p-0">
                            <div style="margin-top:1.5vw">
                                <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Occupancy</p>
                                <input type="text" name="occupancy" class="px-24 w-100" 
                                style="width:50%;padding:0vw 0.4vw" placeholder="Insert your occupancy" required
                                value="{{auth()->user()->occupancy}}">
                                <br>
                                @error('occupancy')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
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

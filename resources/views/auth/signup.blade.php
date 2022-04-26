<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iprospect Timesheet Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet"  type="text/css"  href="/css/index.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="icon" href="/assets/iProspect_Squared_Logo.png">

</head>
<body style="background-color:#8FC449">
    <div class="row m-0 page-container" style="padding-top:8vw;padding-bottom:8vw">

        <div class="col-12" style="text-align:center">
            <p class="px-24 roboto-regular" style="color:#FFFFFF">Disclaimer: This system is not iProspect Official Website.</p>
        </div>

        <!-- START OF LEFT SIDE-->
        <div class="col-md-4" style="padding:5vw">
            <p class="px-18" style="color:#ffffff;white-space:pre-line">This system is the property of iProspect and its affiliates (collectively, “the Company”) and must only be used by authorised individuals, lawfully and in accordance with the applicable company policies.

By using this system you acknowledge this notice and the Company’s right to monitor your use for security and compliance purposes, including e-mail communications sent or received by you.

Unauthorised or improper use of this system may result in disciplinary or legal action.</p>
        </div>
        <!-- END OF LEFT SIDE-->

        <!-- START OF MIDDLE SIDE -->
        <div class="col-md-4" >
            <div style="padding:2vw 2vw;background-color:#F1F1F1;border-radius:1vw">
                <!-- START OF LOGIN FORM -->
                <div style="padding:0vw 2vw">
                    <div style="text-align:center">
                        <img src="assets/iProspect_Logo.png" class="img-fluid" style="width:12vw" alt="IProspect_Logo">
                    </div>
                    <div style="margin-top:4vw">
                        <form action="{{ route('signup') }}" method="post">
                            @csrf
                            <!-- START OF ONE INPUT -->
                            <div>
                                <p class="px-24" style="margin-bottom:0.5vw">Name</p>
                                <input type="text" name="name" class=" px-24 @error('name') is-invalid @enderror" 
                                style="width:100%;padding:0vw 0.4vw" placeholder="Insert your name" required autofocus 
                                value="{{old('name')}}">
                                @error('name')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- END OF ONE INPUT -->

                            <!-- START OF ONE INPUT -->
                            <div style="margin-top:1vw">
                                <p class="px-24" style="margin-bottom:0.5vw">Email Address</p>
                                <input type="email" name="email" class="px-24" 
                                style="width:100%;padding:0vw 0.4vw" placeholder="Insert your email" autofocus required
                                value="{{old('email')}}">
                                @error('email')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- END OF ONE INPUT -->

                            <!-- START OF ONE INPUT -->
                            <div style="margin-top:1vw">
                                <p class="px-24" style="margin-bottom:0.5vw">Password</p>
                                <input type="password" name="password" class="px-24" 
                                style="width:100%;padding:0vw 0.4vw" placeholder="Insert your password" autofocus required
                                value="{{old('password')}}">
                                @error('password')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- END OF ONE INPUT -->

                            <!-- START OF ONE INPUT -->
                            <div style="margin-top:1vw">
                                <p class="px-24" style="margin-bottom:0.5vw">Occupancy</p>
                                <input type="text" name="occupancy" class="px-24" 
                                style="width:100%;padding:0vw 0.4vw" placeholder="Insert your occupancy" autofocus required
                                value="{{old('occupancy')}}">
                                @error('occupancy')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- END OF ONE INPUT -->

                            <!-- START OF ONE INPUT -->
                            <div style="margin-top:1vw">
                                <p class="px-24" style="margin-bottom:0.5vw">Role</p>
                                <select name="user_type_id" class="px-24" id="user_type_id"
                                value="{{old('user_type_id')}}" style="width:100%;padding:0vw 0.4vw" required>
                                    <option disabled selected>Please pick user role</option>
                                    <option value="1">Supervisor</option>
                                    <option value="2">Intern or Freelancer</option>
                                    <option value="3">Human Resource Department</option>
                                </select>
                                @error('user_type_id')
                                    <strong class="px-18" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- END OF ONE INPUT -->

                            <div style="margin-top:2vw;text-align:center">
                                <button class="btn-grey px-24" type="submit" style="width:10vw">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END OF LOGIN FORM -->  
                <!-- START OF BOTTOM SECTION -->
                <div style="margin-top:1.5vw;text-align:center">
                    <p class="px-18" style="margin-bottom:0px">Already have an account?</p>
                    <a href="/signin" class="px-18">Sign in</a>
                </div>
                <div style="text-align:right;margin-top:1vw">
                    <img src="assets/iProspect_Squared_Logo.png" class="img-fluid" style="width:3vw" alt="IProspect_Logo_Square">
                </div>

                <!-- END OF BOTTOM SECTION -->
            </div>

        </div>
        <!-- END OF MIDDLE SIDE -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
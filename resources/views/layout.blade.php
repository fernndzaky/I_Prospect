<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet"  type="text/css"  href="/css/index.css">

    <link rel="icon" href="/assets/iProspect_Squared_Logo.png">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body >
    <!-- START OF NAVBAR -->
    <div class="row m-0" style="padding:1vw 2vw;background-color:#F1F1F1">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div>
            <p class="px-36" style="font-weight:bold;color:#92D050;margin-bottom:0px" >iProspect Timesheet App</p>
          </div>
          <div style="display:flex;align-items:center">
              <div style="text-align:right">
                <p class="px-24" style="font-weight:bold;color:#92D050;margin-bottom:0px" >Welcome, <br> {{auth()->user()->name}}</p>
              </div>
              <div style="margin-left:1vw">
                @if(auth()->user()->avatar)
                <img src="/{{auth()->user()->avatar}}" class="img-fluid" style="height:3vw" alt="User_Icon">
                @else
                <img src="/assets/User_Icon.png" class="img-fluid" style="height:3vw" alt="User_Icon">
                @endif
              </div>
          </div>
        </div>
    </div>
    <!-- END OF NAVBAR -->
    <!-- START OF BODY -->
    <div class="row m-0" style="height:100% ">
      <!-- START OF LEFT SIDEBAR -->
        <div class="col-md-2" style="background-color:#92D050;padding:2vw;">
          <ul>

            <!-- IF USER IS SUPERVISOR -->
            @if(Auth::user()->user_type_id == 1)
            <li style="color:#ffffff;margin-top:2vw">
              <a href="/dashboard"  class="px-24 sidebar-item" style="color:#ffffff;text-decoration:none;
              @if( Request::is('dashboard') )
              font-weight:bold;
              @endif
              ">
              List of Supervision</a>
            </li>

            <!-- IF USER IS INTERN OF FREELANCER -->
            @else
            <li style="color:#ffffff;margin-top:2vw">
              <a href="/dashboard"  class="px-24 sidebar-item" style="color:#ffffff;text-decoration:none;
              @if( Request::is('dashboard') )
              font-weight:bold;
              @endif
              ">Timesheet List</a>
            </li>
            @endif

            <li style="color:#ffffff;margin-top:2vw">
              <a href="/profile" class="px-24 sidebar-item" style="color:#ffffff;text-decoration:none;
              @if( Request::is('profile') )
              font-weight:bold;
              @endif">Account Info</a>
            </li>
          </ul>
          <div style="margin-top:2vw">
            <form action="{{ route('signout') }}" method="post">
                @csrf
                <button type="submit" class="btn-grey px-24" style="width:100%;text-align:center;text-decoration:none">Sign Out  </button>
            </form>
          </div>
        </div>
      <!-- END OF LEFT SIDEBAR -->
      <!-- START OF CONTENT -->
        <div class="col-md-10">
          @yield('container')

        </div>
      <!-- END OF CONTENT -->
    </div>
    <!-- END OF BODY -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- START OF SCRIPT FOR CUSTOM FILE UPLOAD -->
    <script>
    $('#file-upload').change(function() {
        console.log('Test')
        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $(this).prev('label').text(file);
    });
    </script>
    <!-- END OF SCRIPT OF FILE UPLOAD -->
</body>
</html>
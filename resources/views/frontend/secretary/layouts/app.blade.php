<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Welcome {{ $custominfo->fullname }}! | BD-ICU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }} ">
    
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ url('assets/css/owl.theme.default.min.css') }} ">
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }} ">

    <link rel="stylesheet" href="{{ url('assets/css/aos.css') }} ">

    <link rel="stylesheet" href="{{ url('assets/css/ionicons.min.css') }} ">
    
    <link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }} ">
    <link rel="stylesheet" href="{{ url('assets/css/icomoon.css') }} ">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }} ">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"> 
  </head>
  <body>
  	<div class="container" style="background:#fff; box-shadow:#f0f0f0 0 0 4px 4px; padding:0;">
        @section('sidebar')
        	<div class="row">
            	<div class="col-lg-12 d-block">
          		  <div class="py-2" style=" background-color: #006A4E">                
                 		
                            <div class="row d-flex">
                                <div class="col-md-5 col-xs-12 d-flex topper align-items-center"> <span  style="color:#fff; margin-left:10px;">One Stop Digital Education Portal</div>
                                <div class="col-md-7  col-xs-12 pull-right">
                                	<div class="searchrightmenu">
                                        <ul>
                                            
                                            <!--<li><a href="#">Engilsh</a></li>-->
                                            <?php /*?>!Auth::guard('hospital')->check() || !Auth::guard('institute')->check() || <?php */?>
                                             @if (Auth::guard('hospital')->check())
                                              <li><a href="{{ route('hospital.profile') }}">{{ $custominfo->fullname }}</li>
                                                <li><a href="{{ route('hospital.logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                     <form id="logout-form" action="{{ route('hospital.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                                </li>
                                            @else
                                                  <li><a href="{{ URL::to('hospital') }}">Login</a></li>
                                                <li><a href="{{ URL::to('hospital/register') }}">Register</a></li>
                                            @endif
                            
                            
                                            <li><a href="#">Contact</a></li>
                                            <li><a href="{{ route('home')}}">Home</a></li>
                                           <li><a href="#">{{ date('l, d F Y') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
            </div>
    		
            <div class="col-sm-12">
            	<div class="col-sm-3"><a class="navbar-brand" href="{{ route('home')}}"><img src="{{ url('assets/images/bdicu.jpg') }}" style="width:80%; height:auto"></a></div>
                <div class="col-sm-4">
                    <div class="searchboxarea">
                        <form method="get" action="#">
                        {{ csrf_field() }}
                            <label for="keywords" style="display:none" title="Search">Search</label>
                            <input type="text" name="keywords" id="keywords" class="inputbox" placeholder="Search here what you want..." title="Search for products, brand and more...">
                            <button type="submit" class="submitbtn" title="Search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5">
                	<div class="sociallinks">
                        <a href="#" style="color:#4267B2; padding:0 10px;"><i class="fa fa-facebook"></i></a>
                        <a href="#" style="color:#1AB2E8"><i class="fa fa-twitter"></i></a>
                        <a href="#" style="color:#0077B5"><i class="fa fa-linkedin"></i></a>
                        <a href="#" style="color:#FF0000"><i class="fa fa-youtube"></i></a>
                        <span class="phonearea">
                            <img src="{{ url('assets/images/phone.png') }}" style="width:160px; height:auto">
                            <div style="position:absolute; width:100%; float:left; margin:-42px 0 0 -190px; font-size:18px; color:#fff; font-weight:bold">01819312570</div>
                        </span>
                        <img src="{{ url('assets/images/chat.png') }}" style="width:100px; height:auto; margin-top:10px;">
                    </div>
                </div>
                
            </div>
            
      <div class="col-sm-12">
        <nav class="navbar navbar-expand-lg  ftco_navbar ftco-navbar-light" id="ftco-navbar">
           <div class="" style="float:left; text-align:left">
            
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" 
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>
        <div class="collapse navbar-collapse" id="ftco-nav" style="float:left; text-align:left">
        <ul class="navbar-nav ml-auto" style="float:left; text-align:left">                       
             <li class="nav-item"><a href="{{ url('/') }}" class="nav-link"  style="border:none; color:#fff">হোম</a></li>
             <li class="nav-item"><a href="{{ url('hospital/profile/') }}" class="nav-link"  style="border:none; color:#fff">আমার অ্যাকাউন্ট</a></li>            
              
             <li class="nav-item"><a href="{{ url('hospital/profile/') }}" class="nav-link"  style="border:none; color:#fff">আমার আবেদন</a></li>
             <li class="nav-item"><a href="{{ url('hospital/paymentinfo/') }}" class="nav-link"  style="border:none; color:#fff">আমার পেমেন্ট</a></li>
             <li class="nav-item"><a href="{{ url('hospital/setting/') }}" class="nav-link"  style="border:none; color:#fff">তথ্য পরিবর্তন</a></li>
             <li class="nav-item"><a href="{{ url('hospital/change-password/') }}" class="nav-link"  style="color:#fff">পাসওয়ার্ড পরিবর্তন</a></li>
             <li class="nav-item"><a href="{{ url('hospital/change-password/') }}" class="nav-link"  style="color:#fff;">লগআউট</a></li>
        </ul>
          </div>
        </div>
       </nav>
        </div>
   </div>
@show

        @yield('content')
        
        
        @section('footer')
            	<footer class="ftco-footer ftco-bg-dark ftco-section">
                   <div class="container">
                    <div class="col-xs-12 col-sm-3">
                   	<div style="width:100%; height:auto; margin:auto; text-align:center; margin:10px;">
                    <a href="{{ route('home') }}">
                    <img src="{{ url('assets/images/flogo.png') }}" style="width:70%; height:auto; text-align:center"></a></div>
                    
                    <div style="width:100%; height:auto;margin:auto; text-align:center">
                        <a href="https://smallseotools.com/visitor-hit-counter/" target="_blank" title="Visitor Hit Counter">
                        <img src="https://smallseotools.com/counterDisplay?code=33b6eed26deac7c2acee158a548c8b96&style=0006&pad=7&type=ip&initCount=456233"  title="Visitor Hit Counter" Alt="Visitor Hit Counter" border="0" style="width:100%; height:auto">
                        </a>
                    </div>


                   </div>                   
                   	<div class="col-xs-12 col-sm-3">
                    	<div class="footermenu">
                           <ul>
                               @foreach($fmenus as $wm)
                                    <li><a href="#">{{ $wm->title }}</a></li>
                               @endforeach   
                           </ul>
                         </div>
                      </div>
                    <div class="col-xs-12 col-sm-3">
                    	<div class="footermenu">
                           <ul>
                               @foreach($fmenus1 as $wm)
                                    <li><a href="#">{{ $wm->title }}</a></li>
                               @endforeach   
                           </ul>
                         </div>
                      </div>
                      
                   </div>
                    <!--<div class="row">
                      <div class="col-md-12 text-center">
            
                        <p>
              Copyright &copy; BD-ICU. Design and Develop by <a href="https://copotronic.com" target="_blank">Copotronic</a>
             </p>
                      </div>
                    </div>-->
                </footer>
            
            
              <script src="{{ url('assets/js/jquery.min.js') }} "></script>
              <script src="{{ url('assets/js/jquery-migrate-3.0.1.min.js') }} "></script>
              <script src="{{ url('assets/js/popper.min.js') }} "></script>
              <script src="{{ url('assets/js/bootstrap.min.js') }} "></script>
              <script src="{{ url('assets/js/jquery.easing.1.3.js') }} "></script>
              <script src="{{ url('assets/js/jquery.waypoints.min.js') }} "></script>
              <script src="{{ url('assets/js/jquery.stellar.min.js') }} "></script>
              <script src="{{ url('assets/js/owl.carousel.min.js') }} "></script>
              <script src="{{ url('assets/js/jquery.magnific-popup.min.js') }} "></script>
              <script src="{{ url('assets/js/aos.js') }} "></script>
              <script src="{{ url('assets/js/jquery.animateNumber.min.js') }} "></script>
              <script src="{{ url('assets/js/scrollax.min.js') }} "></script>
              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
              <script src="{{ url('assets/js/google-map.js') }} "></script>
              <script src="{{ url('assets/js/main.js') }} "></script> 
			  <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    
        @show
        </div>
    </body>
</html>
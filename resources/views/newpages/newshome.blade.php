<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>@yield('title','userindex')</title>

  
    <link href="{{asset('asset/css/custom.css')}}" rel="stylesheet"> 
  <link href="{{asset('asset/js/bootstrap.min.js')}}" rel="stylesheet">
  <link href="{{asset('asset/css/jquery.datatables.css')}}" rel="stylesheet">
  

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container">
  <image   width="100%" src="{{asset('asset/images/logo.PNG')}}"/>
 
      <form class="navbar-form navbar-right" role="search">
          <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
          </div>
              <button type="submit" class="btn btn-default">Submit</button>
      </form>
  </div>
  <!-- end go logo of the header-->

  <!-- Start of menu navigation bar -->
  <div class="container">
     <nav id="navbar-main" class="navbar navbar-inverse navbar-static-top visible-xs-block">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>
    <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
            </li>
       @foreach(App\Category::all() as $category)
            <li class=""><a href="{{url($category->category_id . '/news')}}"><i class="fa fa-page"></i> <span>{{$category->category_name}}</span>
            </a></li>
      @endforeach
         </ul>
      
      <ul class="nav navbar-nav navbar-right ">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login<span class="caret"></span></a>
             <ul class="dropdown-menu">
               @if(!Auth::user())
                  <li><a href="{{url ('User/login')}}"><i class="glyphicon glyphicon-log-in"></i> LogIn</a>
                  </li>
                @endif
                @if(Auth::user())
                   <li><a href="{{ url('auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i>logout</a>
                   </li>
                @endif
                @if(Auth::check() and !Auth::user()->isEndUser())
                   <li><a href="{{ url('User/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a>
                   </li>
              @endif
           </ul>
          </li>
      </ul>
    </div><!-- /.navbar-collapse-->

  <!-- </div>/.containe r-fluid -->
  </div>
  </nav>
<!---/ end of navigation for the menu bar -->


<!--/ content of the system-->
@yield('content')

 
<div class="container"></div>
</body>



<script src="{{asset('asset/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('asset/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/modernizr.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('asset/js/toggles.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.cookies.js')}}"></script>

{{-- <script src="{{asset('asset/js/flot/flot.min.js')}}"></script> --}}
{{-- <script src="{{asset('asset/js/flot/flot.resize.min.js')}}"></script> --}}
<script src="{{asset('asset/js/morris.min.js')}}"></script>
<script src="{{asset('asset/js/raphael-2.1.0.min.js')}}"></script>

<script src="{{asset('asset/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('asset/js/chosen.jquery.min.js')}}"></script>

<script src="{{asset('asset/js/custom.js')}}"></script>
<script src="{{asset('asset/js/jquery.validate.min.js')}}"></script>
{{-- <script src="{{asset('asset/js/dashboard.js')}}"></script> --}}
@yield('script')
</html>

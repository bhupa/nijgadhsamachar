<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>@yield('title','userindex')</title>

  <link href="{{asset('asset/css/style.default.css')}}" rel="stylesheet">
  <link href="{{asset('asset/css/jquery.datatables.css')}}" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span class="text-primary"><a href='{{url('/')}}'> Nijgdh samachar </a></span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->



      <ul class="nav">
        @foreach(App\Category::all() as $category)
          <li class=""><a href="{{url($category->category_id . '/news')}}"><i class="fa fa-page"></i> <span>{{$category->category_name}}</span></a></li>
          @endforeach
      </ul>


    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->


  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">Home <span class="sr-only"></span></a></li>
        <li><a href="#">About Us</a></li>
        <li>
          <ul class="headermenu">
            <li>
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cog fa-2x"></i>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                 @if(!Auth::user())
                  <li><a href="{{url ('User/login')}}"><i class="glyphicon glyphicon-log-in"></i> LogIn</a></li>
                 @endif
                 @if(Auth::user())
                 <li><a href="{{ url('User/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a></li>
                <li><a href="{{ url('auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i>logout</a></li>
              @endif
                </ul>
              </div>
            </li>

          </ul>
      </li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>



    </div><!-- headerbar -->
     <div class="contentpanel">
    @yield ('content')
    @yield('main')
  </div>

    </div>




</section>
<div class="modal-container"></div>

<script src="{{asset('asset/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('asset/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/modernizr.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('asset/js/toggles.min.js')}}"></script>
<script src="{{asset('asset/js/retina.min.js')}}"></script>
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
</body>
</html>

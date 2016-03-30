<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>@yield('title','userindex')</title>

  <link href="{{asset('public/asset/css/style.default.css')}}" rel="stylesheet">
  <link href="{{asset('public/asset/css/jquery.datatables.css')}}" rel="stylesheet">

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
        <h1><span> Nijgdh samachar </span></h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->

      
      
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="active"><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li></br>
         @if(!Auth::user())

                         <div class="image">
                             <img src="{{asset('resources/assets/images/default.png')}}" class="img-circle">
                          <div id="imagename"><p align="center"><strong>User_Type</strong></p></div>
                         </div>
                           <li class=""><a href="{{ url('User/index') }}"> Home</a></li>
                           <li  ><a href="{{ url('User/adduser') }}"><span class="glyphicon glyphicon-user"></span> Add_User</a></li>
                          @endif
                            
                         @if(Auth::user())
                         
                            @if(Auth::user()->isAdmin())
                            <div class="nav-parent">
          <img src="{{ Auth::user()->getImage() }}" class="thumbnail img-responsive"  />
          
          </div>
                        <li class="nav-parent"><a href="#"><i class="fa fa-edit"></i> <span>Reporter</span></a>
                        <ul class="children">
                         <li><a href="{{ url('admin/addreporter/'.Auth::user()->user_id) }}"><i class="fa fa-caret-right"></i> Add User</a></li>
                         <li><a href="{{ url('admin/viewuser/'.Auth::user()->user_id) }}"><i class="fa fa-caret-right"></i> View Reporter</a></li>
                      </ul>
                      </li>
                      <li class="nav-parent"><a href="#"><i class="fa fa-edit"></i> <span>News</span></a>
                        <ul class="children">
                         <li><a href="{{ url('admin/addnews/') }}"><i class="fa fa-caret-right"></i> Add News</a></li>
                         <li><a href="{{ url('admin/viewnews/') }}"><i class="fa fa-caret-right"></i> View News</a></li>
                      </ul>
                      </li>
                      <li class="nav-parent"><a href="#"><i class="fa fa-edit"></i> <span>Category</span></a>
                        <ul class="children">
                         <li><a href="{{ url('admin/addnews/') }}"><i class="fa fa-caret-right"></i> Add Category</a></li>
                      </ul>
                      </li>

                                {{-- <li  ><a href="{{ url('admin/viewuser/'.Auth::user()->user_id) }}"><span class="glyphicon glyphicon-user"></span>View_Reporter</a></li>
                                <li  ><a href="{{ url('admin/addreporter/'.Auth::user()->user_id) }}"><span class="glyphicon glyphicon-user"></span>Add_Reporter</a></li>
                                <li> <a href="{{ url('admin/addnews/') }}"><span class="glyphicon glyphicon-user"></span>Add_News</a></li>
                                 <li> <a href="{{ url('admin/viewnews/') }}"><span class="glyphicon glyphicon-user"></span>View_News</a></li>
                                <li  ><a href="{{ url('admin/addcategory') }}"><span class="glyphicon glyphicon-user"></span>Category</a></li> --}}
                            @endif

                            @if(!Auth::user()->isAdmin())
                            <li class="nav-parent"><a href="#"><i class="fa fa-edit"></i> <span>News</span></a></li>
                        <ul class="children">
                         <li><a href="{{ url('User/addnews') }}"><i class="fa fa-caret-right"></i> Add News</a></li>
                         <li><a href="{{ url('User/usernewslist') }}"><i class="fa fa-caret-right"></i> View News</a></li>
                                </ul>
                                <li><a href="{{ url('User/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a></li>
                            @endif
                            
                             <li><a href="{{ url('auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                             </ul>
                      @endif
              
        
      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  

  <div class="mainpanel">
    
    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
      <form class="searchform" action="http://themepixels.com/demo/webpage/bracket/index.html" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
      </form>
      
      <div class="header-right">
        <ul class="headermenu">
        
           
          
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"></i>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
              @if(!\Auth::user())
                <li><a href="{{url ('User/login')}}"><i class="glyphicon glyphicon-log-in"></i> LogIn</a></li>
               @endif
               @if(Auth::user())
              @if(Auth::user()->isAdmin())
            <li><a href="{{ url('admin/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a></li>
              
              @endif
               @if(!\Auth::user()->isAdmin())
            
               <li><a href="{{ url('User/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a></li>
              
              @endif

              <li><a href="{{ url('auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i>logout</a></li>
            @endif
              </ul>
            </div>
          </li>
          
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
     <div class="contentpanel">
    @yield ('content')
    @yield('main')
  </div>
    
    </div>
    
       
  
  
</section>
<div class="modal-container"></div>

<script src="{{asset('public/asset/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('public/asset/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('public/asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/asset/js/modernizr.min.js')}}"></script>
<script src="{{asset('public/asset/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('public/asset/js/toggles.min.js')}}"></script>
<script src="{{asset('public/asset/js/retina.min.js')}}"></script>
<script src="{{asset('public/asset/js/jquery.cookies.js')}}"></script>

{{-- <script src="{{asset('public/asset/js/flot/flot.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/asset/js/flot/flot.resize.min.js')}}"></script> --}}
<script src="{{asset('public/asset/js/morris.min.js')}}"></script>
<script src="{{asset('public/asset/js/raphael-2.1.0.min.js')}}"></script>

<script src="{{asset('public/asset/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('public/asset/js/chosen.jquery.min.js')}}"></script>

<script src="{{asset('public/asset/js/custom.js')}}"></script>
<script src="{{asset('public/asset/js/jquery.validate.min.js')}}"></script>
{{-- <script src="{{asset('public/asset/js/dashboard.js')}}"></script> --}}
@yield('script')
</body>
</html>
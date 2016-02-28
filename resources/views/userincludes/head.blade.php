<div class="sidebar">
          <ul id="nav">
             <li><a class="selected" href="">Dahboard</a></li>
                    
                         @if(!Auth::user())
                         <div class="image">
                             <img src="{{asset('resources/assets/images/default.png')}}" class="img-circle">
                          <div id="imagename"><p align="center"><strong>User_Type</strong></p></div>
                         </div>
                           <li class=""><a href="{{ url('User/index') }}"></span> Home</a></li>
                           <li  ><a href="{{ url('User/adduser') }}"><span class="glyphicon glyphicon-user"></span> Add_User</a></li>
                          @endif

                            {{-- <img src="{{ Auth::user()->getImage() }}"></ul> --}}
                         @if(Auth::user())
                         <div class="image">
                             <img src="{{ Auth::user()->getImage() }}" width="200" height="200" class="img-circle">
                          <div id="imagename"><p align="center"><strong>{{ Auth::user()->getUser_type() }}</strong></p></br>
                         </div>
                            @if(Auth::user()->isAdmin())
                                <li  ><a href="{{ url('admin/viewuser/'.Auth::user()->user_id) }}"><span class="glyphicon glyphicon-user"></span>View_Reporter</a></li>
                                <li  ><a href="{{ url('admin/addreporter/'.Auth::user()->user_id) }}"><span class="glyphicon glyphicon-user"></span>Add_Reporter</a></li>
                                <li  ><a href="{{ url('admin/addcategory') }}"><span class="glyphicon glyphicon-user"></span>Category</a></li>
                            @endif

                            @if(!Auth::user()->isAdmin())
                                <li><a href="{{ url('User/addnews') }}">News</a></li>
                                <li><a href="{{ url('User/usernewslist') }}">View_News</a></li>
                                <li><a href="{{ url('User/viewprofile/'. Auth::user()->user_id) }}">view_Profile</a></li>
                            @endif
                            <li><a href="{{ url('auth/logout') }}">logout</a></li>
                      @endif
              
              
          </ul>
        </div>
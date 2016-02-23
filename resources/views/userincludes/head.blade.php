<div class="sidebar">
          <ul id="nav">
             <li><a class="selected" href="">Dahboard</a></li>
                      <div class="image">
                        <img src="{{asset('resources/assets/images/default.png')}}" class="img-circle">
                        <div id="imagename"><p align="center"><strong>User_Type</strong></p></div>
                      </div>
              <li class=""><a href="{{ url('User/index') }}"></span> Home</a></li>
              <li><a href="{{ url('News/index') }}">Add_News</a></li>
               <li  ><a href="{{ url('User/adduser') }}"><span class="glyphicon glyphicon-user"></span> Add_User</a></li>
              <li><a href="{{ url('News_Category/add_category') }}">Add_Category</a></li>
              
              <li><a href="{{ url('auth/logout') }}">logout</a></li>
              <li><a href="">News</a></li>
          </ul>
        </div>
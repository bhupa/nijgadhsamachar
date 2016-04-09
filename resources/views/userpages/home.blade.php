@extends('try.index')
@section('title')
UserSignIn
@stop
@section ('content')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> Dashboard</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">Login And Post Your News:</span>
      </div>
    </div>
@stop
@section('main')
<div class="contentpanel">

         
     @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
          <section>
  
    <div class="signuppanel">
        
        <div class="row">
            
            <div class="col-md-6">
                
                <div class="signup-info">
                    <div class="logopanel">
                        <h1><span>[</span> bracket <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Bootstrap 3 Admin Template!</strong></h5>
                    <p>Bracket is a theme that is perfect if you want to create your own content management, monitoring or any other system for your project.</p>
                    <p>Below are some of the benefits you can have when purchasing this template.</p>
                    <div class="mb20"></div>
                    
                    <div class="feat-list">
                        <i class="fa fa-wrench"></i>
                        <h4 class="text-success">Easy to Customize</h4>
                        <p>Bracket is made using Bootstrap 3 so you can easily customize any element of this template following the structure of Bootstrap 3.</p>
                    </div>
                    
                    <div class="feat-list">
                        <i class="fa fa-compress"></i>
                        <h4 class="text-success">Fully Responsive Layout</h4>
                        <p>Bracket is design to fit on all browser widths and all resolutions on all mobile devices. Try to scale your browser and see the results.</p>
                    </div>
                    
                    <div class="feat-list mb20">
                        <i class="fa fa-search-plus"></i>
                        <h4 class="text-success">Retina Ready</h4>
                        <p>When a user load a page, a script checks each image on the page to see if there's a high-res version of that image. If a high-res exists, the script will swap that image in place.</p>
                    </div>
                    
                    <h4 class="mb20">and much more...</h4>
                
                </div><!-- signup-info -->
            
            </div><!-- col-sm-6 -->
            
            <div class="col-md-6">
                
                <form method="post" id="adduser" action="{{ URL::to('User/storeuser') }}" 
              enctype="multipart/form-data" accept="image/gif,image/jpeg">
                    
                    <h3 class="nomargin">Sign Up</h3>
                    <p class="mt5 mb20">Already a member? <a href="signin.html"><strong>Sign In</strong></a></p>
                
                    
                    
                    <div class="mb10">
                        <label for="firstname" class="control-label">First_Name</label>
              <input name="firstname"class="form-control" type="text" id="firstname">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('firstname') }}</div>
                    </div>
                  <div class="mb10">
                    <label for="lastname">Last_Name</label>
              <input name="lastname" class="form-control" id="lastname">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('lastname') }}</div>
                    </div>
                    <div class="mb10">
                    <label for="select">Gender:</label>
             <select  name="gender"  class="form-control" id="gender" type="gender" size="1">
                <option value="" >---Gender-----</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
             </select>
             <div class="error" style="color:red; font-size:15px;">{{ $errors->first('gender') }}</div>   
                    </div>
                    <div class="mb10">
                     <label for="select">User_Type</label>
              <select  name="user_type"  class="form-control" id="user_type" type="user_type" size="1"> 
                  <option value="" >---User_Type-----</option>
                  <option value="Admin">Admin</option>
                  <option value="Reporter">Reporter</option>
                  <option value="End User">End User</option>
              </select>
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('user_type') }}</div>
   
                    </div>
                    <div class="mb10">
                      <label for="address">Address</label>
            <input type="text" class="form-control" name="address"  id="address">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('address') }}</div>

                    </div>
                    <div class="mb10">
                    <label for="phone">Phone</label>
            <input  name="contact" type="number" class="form-control"  id="phone">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('contact') }}</div>
                    </div>
                    <div class="mb10">
                    <label for="image">Images</label>
              <input type="file" name="image" id="image" >
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('image') }}</div>
                    </div>
                    <div class="mb10">
                     <label for="email">Email address:</label>
            <input name="email"class="form-control" size="50" id="email">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('email') }}</div> 
                    </div>
                    
                   <div class="mb10">
                     <label for="pwd">Password:</label>
            <input name="password" class="form-control" type="password" id="password">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('password') }}</div>
                   </div>
                    
                    <div class="mb10">
                        <label for="password">confrom_password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('cpassword') }}</div>
                    </div>
                    
                  
                    
                  
                    <br />
                    
                    <button class="btn btn-success btn-block">Sign Up</button>     
                </form>
            </div><!-- col-sm-6 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved. Bracket Bootstrap 3 Admin Template
            </div>
            <div class="pull-right">
                Created By: <a href="http://themepixels.com/" target="_blank">ThemePixels</a>
            </div>
        </div>
        
    </div><!-- signuppanel -->
  
</section>

            {{--  <form method="POST" action="{{ url('/auth/login') }}">
    {!! csrf_field() !!}
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                         </div>
                         <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit"name="submit_login" id="login" class="btn btn-info">Submit</button>
            </form> --}}
            </div>
            
@stop
  @section('script')
     <script type="text/javascript">
        $(document).ready(function(){  
        
                      $("#adduser").validate({
                                     rules:
                                     {
                                          firstname:{  required: true },
                                          lastname: { required: true },
                                          gender:{ required: true },
                                          user_type:{ required:  true },
                                          address:{ required: true},
                                          contact:{ required: true, number: true},
                                          image:{ required: true },
                                          email:{ required: true, email: true },
                                         password:{ required: true},
                                         cpassword:{ equalTo: '#password' }
                                     }
                        });


       
  $(document).on('submit','#adduser',function(e){
     e.preventDefault()
      $this = $(this);
      var d =$(this).data();
      if(!d.validator.valid()){return false;}
      var form = $(this);
    console.log('we are');
      var url = form.prop('action');
      console.log(url);
      var formData = new FormData($(this)[0]);

console.log(formData);

        $.ajax({
          url:$(this).attr('action'),
          type: 'POST',
          dataType :"json",
          data: formData,
          cache: false,
                  contentType: false,
                  processData: false, 
          success: function (res) {
            if(res)
            {
              
             notifier.successNotify(res);
             form.trigger('reset')
          }
          else
          {

            return false;
          }
          
        },
        error:function(res)
                  {
                    
                      notifier.errorNotify(res)
                  }
        });

        
      });
var notifier =
{
errorNotify:function(res)
{
var error = res.responseJSON;
var modalData = {};
modalData.title = "Error !"
modalData.body ="<p style='color:red'>These are the following error:";
$.each(error, function(key, value)
{
modalData.body += "<p style='text-decoration:underline'>"+key+"</p>";
for(var i = 0; i < value.length; i++)
{
  modalData.body +=("<span>" +value[i]+"<span>");
}
});
modalData.footer="please make sure your input is correct";
init_modal(modalData);
},
successNotify : function (data)
{
  init_modal({
                  "title" : "A new user is saved",
                  "body" : data.firstname + " " + data.lastname + " is the user",
                  "footer": ""
              });

}

}


});
    </script>
@stop
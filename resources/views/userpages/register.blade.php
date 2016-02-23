@extends('user.master')

 @section('content')
  <div id="box">
      <div class="box-top">Add New User</div>
           @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
        <form method="POST" id="adduser"
              action="{{ URL::to('User/storeuser') }}" 
              enctype="multipart/form-data" accept="image/gif,image/jpeg">
           
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    
              <div class="form-group">
              <label for="firstname">First_Name</label>
              <input name="firstname"class="form-control" type="text" id="firstname">
             {{--  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('firstname') }}</div> --}}

              <label for="lastname">Last_Name</label>
              <input name="lastname" class="form-control" id="lastname">
             {{--  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('lastname') }}</div> --}}

             <label for="select">Gender:</label>
             <select  name="gender"  class="form-control" id="gender" type="gender" size="1">
                <option value="" >---Gender-----</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
             </select>
             {{-- <div class="error" style="color:red; font-size:15px;">{{ $errors->first('gender') }}</div>   --}} 

              <label for="select">User_Type</label>
              <select  name="user_type"  class="form-control" id="user_type" type="user_type" size="1"> 
                  <option value="" >---User_Type-----</option>
                  <option value="Admin">Admin</option>
                  <option value="Reporter">Reporter</option>
              </select>
              {{-- <div class="error" style="color:red; font-size:15px;">{{ $errors->first('user_type') }}</div> --}}
   
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address"  id="address">
            {{-- <div class="error" style="color:red; font-size:15px;">{{ $errors->first('address') }}</div> --}}

            <label for="phone">Phone</label>
            <input  name="contact" type="number" class="form-control"  id="phone">
            {{-- <div class="error" style="color:red; font-size:15px;">{{ $errors->first('contact') }}</div> --}}

            <div class="form-group">
              <label for="image">Images</label>
              <input type="file" name="image" id="image"  >
           {{--  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('image') }}</div>
            </div> --}}

            <label for="email">Email address:</label>
            <input name="email"class="form-control" size="50" id="email">
           {{--  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('email') }}</div> --}}

            <label for="pwd">Password:</label>
            <input name="password" class="form-control" type="password" id="password">
            {{-- <div class="error" style="color:red; font-size:15px;">{{ $errors->first('password') }}</div> --}}

            <label for="password">confrom_password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">
           {{--  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('cpassword') }}</div></div> --}}

            <button type="submit" class="btn btn-default" name="submit_add_user"  value="submit">Submit</button>
    </form>
  </div>
  </div>
      <script src="{{asset('resources/assets/js/jquery.js')}}"></script> 
      <script src="{{asset('resources/assets/js/jquery.validate.js')}}"></script>
      <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script> 
  
    <script type="text/javascript">
    
        jQuery(document).ready(function(){  
        

                      // $("#adduser").validate({
                      //                rules:
                      //                {
                      //                     firstname:{  required: true ,min: 3, alpha: true },
                      //                     lastname: { required: true ,min: 3, alpha: true },
                      //                     gender:{ required: true },
                      //                     user_type:{ required:  true },
                      //                     address:{ required: true},
                      //                     contact:{ required: true, number: true},
                      //                     image:{ required: true },
                      //                     email:{ required: true, email: true },
                      //                     password:{ required: true, alpha_num: true, min:6 },
                      //                     cpassword:{ equalTo: "#password" }
                      //                },
                                
                      //                submitHandler: function(form,event){  event.preventDefault()}
                      //   });


// $('#adduser').on('submit',function(e){
        
       
//   $(document).on('submit','#adduser',function(e){
     
//       e.preventDefault();

//        var formData = new FormData($(this)[0]);

//         $.ajax({
//           url:$(this).attr('action'),
//           type: 'POST',
//           data: formData,
//           success: function (data) {
//               init_modal({
//                   "title" : "A new user is saved",
//                   "body" : data.newuser.firstname + " " + data.newuser.lastname + " is the user",
//                   "footer": ""
//               })

//               $(this).trigger('reset')
//           },
//           cache: false,
//           contentType: false,
//           processData: false
//         });

//         return false;
//       })


// });
    </script>
@stop
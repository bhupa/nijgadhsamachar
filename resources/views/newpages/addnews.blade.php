@extends('user.master')

 @section('content')
             @include('tinymce::tpl')
  <div id="box">
      <div class="box-top">Add News</div>
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
              <label for="firstname">Title</label>
              <input name="title"class="form-control" type="text" id="firstname">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('firstname') }}</div>

              <label for="lastname">Category</label>
              {{ Form::select('category_name', $category->lists("category_name","category_id"),null, array('class'=>'form-control')) }}
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('lastname') }}</div>
              <div class="form-group">
              <label for="Content">Content</label>
              <textarea id="tinymce" rows="50"></textarea>
              </div>

            <div class="form-group">
              <label for="image">Images</label>
              <input type="file" name="image" id="image"  >
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('image') }}</div>
            </div>


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
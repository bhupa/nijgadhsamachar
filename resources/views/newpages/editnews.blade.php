@extends('try/index')

 @section('content')
             @include('tinymce::tpl')
  <div id="box">
      <div class="box-top">Add News</div>
           @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
        <form method="POST" id="editnews"
              action="{{ URL::to('User/usersavenews/'.$news->news_id) }}"
              enctype="multipart/form-data" accept="image/gif,image/jpeg">

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

              <div class="form-group">
              <label for="firstname">Title</label>
              <input name="title"class="form-control" type="text" id="firstname" value="{{$news->title}}">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('title') }}</div>

              <label for="lastname">Category</label>
              {{ Form::select('category_type', $category->lists("category_name","category_id"),$news->category->category_id, array('class'=>'form-control')) }}
              <div class="form-group">
              <label for="Content">Content</label>
              <textarea id="tinymce" name="body" rows="50" >{{$news->body}}</textarea>
              </div>

            <div class="form-group">
              <label for="image">Images</label>
              <input type="file" name="image" id="image"  >
              <img src="{{ $news->getImage() }}" height="50" width="50">

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


                      $("#editnews").validate({
                                     rules:{title:{  required: true } },
                                      messages: {title:{
                                     required: "News title field is required"}
       }

                                     submitHandler: function(form,event){  event.preventDefault()}
                        });


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


 });
    </script>
@stop

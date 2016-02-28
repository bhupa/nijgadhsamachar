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
        <form method="POST" id ="addnews"
              action="{{ URL::to('User/usernews') }}" 
              enctype="multipart/form-data" accept="image/gif,image/jpeg">
           
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    
              <div class="form-group">
              <label for="firstname">Title</label>
              <input name="title"class="form-control" type="text" id ="firstname">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('title') }}</div>

              <label for="lastname">Category</label>
              {{ Form::select('category_type', $category->lists("category_name","category_id"),null, array('class'=>'form-control')) }}
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('category_type') }}</div>
              <div class="form-group">
              <label for="Content">Content</label>
              <textarea id="tinymce" name="body"  rows="50"></textarea>
              </div>
<div class="error" style="color:red; font-size:15px;">{{ $errors->first('body') }}</div>
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
        

                      $("#addnews").validate({
                                     rules:
                                     {
                                          title:{  required: true  },
                                          body:{ required: true },
                                          image:{ required: true }
                                         
                                     },
                                
                                     submitHandler: function(form,event){  event.preventDefault()}
                        });
                       $('#addnews').on('submit',function(){
                $this = $(this);
                var d = $(this).data();
                if(!d.validator.valid()){return false; }
                var form = $(this);
                var url  = form.prop('action'); 
                 var formData = new FormData($(this)[0]);
                formData.append('body', tinymce.get('tinymce').getContent())
                console.log($('#tinymce').val());
            $.ajax({
                  url:url,
                  type:"POST",
                  dataType: "json",
                  data:formData,
                  cache: false,
                  contentType: false,
                  processData: false,         
                  success:function(res)
                  {
                  
                    if (res) 
                    {
                      notifier.successNotify(res)
                       
                  }
                    else
                    {
                      alert('error');
                    }
                  },

                  error:function(res)
                  {
                    
                      notifier.errorNotify(res)
                  }

                   });
        });

var notifier = {

            errorNotify : function(res){
                   var error = res.responseJSON;  
                   var modalData = {}
                   modalData.title = "Error !"
                   modalData.body = "<p style='color:red'>These are the follwing errors: ";
                  
                 $.each(error,function(key, value){
                  
                  modalData.body += "<p style='text-decoration:underline'>"+key+"</p>";
                   for(var i = 0; i < value.length; i++ ){
                      modalData.body +=  ( "<span>" + value[i] + "<span>" );
                   }
                 }) 

                   modalData.footer= "Please Make Sure Your input is correct";
                   init_modal(modalData);
            },

            successNotify : function(response){


                    init_modal({
                           title: 'Success',
                            body: 'Your Operation is successfully done',
                           footer: ''
                      });
            }


          }


});
    </script>
@stop
@extends('user.master')
@section('content')
    <h1>Category Operation</h1>
   @if (Session::has('flash_message'))
        <div class="alert alert-danger">
          {{ Session::get('flash_message') }}
        </div>
        @endif
        
              <form method="POST" id="category" action="{{ URL::to('admin/create_category/'.Auth::user()->user_id) }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                          <label for="Category">bhupendra</label>
                          <input type="text" class="form-control" name="category_name" id="category_name" placeholder="category_name">

@if ($errors->has())
<p style="color:red; font-size:20px;">
  @foreach ($errors->all() as $error)
    {!! $error !!}<br />    
  @endforeach
</p>
@endif
                         </div>
                        <button type="submit"name="submit_login"  class="btn btn-info">Submit</button>
            </form>
 <div id="box">
      <div class="box-top">Category Table</div>
      <table class="table table-bordered ">
            <tr class="active text-primar
            y" style="background-color:yellow" >
              <td >ID</td>
              <td>Category Name</td> 
              <td>Create Date</td> 
              <td >Update Date</td>
            </tr>
            <tbody class="category-table">
      @foreach ($category as $row)
      <tr class="success">
        
        <td class="category_id" data-category-id="{{$row->category_id}}">{{$row->category_id}}</td>
        <td class="category-name">{{$row->category_name}}</td>
        <td>{{$row->created_at}}</td>
        <td>{{$row->updated_at}}</td>
        <td >
          <a class=" editcategory btn btn-primary" data-id="{{ $row->category_id }}"  href="{{url('/News_Category/editcategory/'.$row->category_id)}}" role="button">Edit</a>
        </td>
        <td >
          <a class=" deletecategory btn btn-primary" data-id="{{ $row->category_id }}"  href="{{url('/News_Category/deletcategory/'.$row->category_id)}}" role="button">Delete</a>
        </td>


      </tr>
    @endforeach
    </tbody>
      </table>

             <script src="{{asset('resources/assets/js/jquery.js')}}"></script> 
      <script src="{{asset('resources/assets/js/jquery.validate.js')}}"></script>
      <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script> 
      <script src="{{asset('resources/assets/js/bootstrap.js')}}"></script> 
  <script src="{{asset('resources/assets/js/tinymce.min.js')}}"></script> 
<script type="text/javascript">
    
    jQuery(document).ready(function(){

            $("#category").validate({
               rules: { category_name:{ required: true, minlength:4} },
             
            messages: {category_name:{
        required: "Category field is required",
        minlength: "Atleast 4 character is required for Category ",
       }
    },
              submitHandler: function(form,event){  event.preventDefault()}
            });
      $('#category').on('submit',function(){
                $this = $(this);
                var d = $(this).data();
                if(!d.validator.valid()){return false; }
                var form = $(this);
                var url  = form.prop('action'); 
            $.ajax({
                  url:url,
                  type:"POST",
                  dataType: "json",
                  data:form.serialize(),
                  success:function(res)
                  {
                  
                    if (res) 
                    {
          
                     
                        category.add( res );

                        $( '#'+form.attr('modal-id') ).modal('hide');
                      
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

          
          //notifer all function
        
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


          $(document).on('submit','.edit-category',function(e){
           e.preventDefault();
           
           $this = $(this);
            var form = $(this);
                var url  = form.prop('action');
                var formdata = form.find('input[name="category_name"]').val();
                if(""  == formdata)
                {
                  alert('Category name is required')
                  return;
                }     
            
              $.ajax({
                  url:url,
                  type:"POST",
                  dataType: "json",
                  data:form.serialize(),
                  success:function(res)
                  {
                    if (res) 
                    {

                      $('#'+form.attr('modal-id')).modal('hide');
                        var id = form.attr('data-category-id')
                       var tr =  $('td[data-category-id="'+id+'"]').parent('tr');
                      tr.find('.category-name').text(res.category_name)
                    }
                    else
                    {
                      alert('error');
                    }
                  } 
                   });
          
      });
     
     $(document).on('click','.editcategory',function(e){
        event.preventDefault();
         category.edit($(this).attr('data-id'),$(this).closest('tr').find('.category-name').text());
      });
     $(document).on('click','.deletecategory',function(e){
        event.preventDefault();
         $this = $(this);
            var form = $(this);
           
        var url  = $(this).attr('href');
        var id = $(this).attr('data-id');
         var row =  $(this).closest('tr');
      $.ajax({
                  url:url,
                  type:"get",
                  dataType: "json",
                  data:form.serialize(),
                  success:function(res)
                  {
                    if (res) 
                    {
                        row.remove();
                       $('#'+form.attr('modal-id')).modal('show');
                     init_modal({
            title: 'Delete Category',
            body: 'Category delete sucessfully',
            footer: ''
            });

                    }
                    else
                    {
                      alert('error');
                    }
                  } 
                   });
      });
});
      var category = {
        add: function(data){
          var view = '<tr class="success">\
              <td>' + data.category_id + '</td>\
              <td>'+data.category_name+'</td>\
              <td>'+data.created_at+'</td>\
              <td>'+data.updated_at+'</td>\
              <td >\
                <a class="edit-btn btn btn-primary" href="{{url('/News_Category/editcategory/')}}'+data.id+ '" role="button">Edit</a>\
              </td>\
              <td >\
                <a class="btn btn-primary" href="{{url('/News_Category/deletcategory/')}}'+data.id+ '" role="button">Delete</a>\
              </td>\
            </tr>';
            console.log(view)
          $('.category-table').append(view)

        },

        edit:function(id,value){
          //html
          //modal
          //update ajax submit
          //update table

            var html = "<form data-category-id='"+id+"' class='edit-category' method='POST' action={{ url('/News_Category/update_category/') }}/"+id+">\
            <input type='hidden' name='_token' id='_token' value='{{ csrf_token() }}'>\
            <div class='form-group'>\
              <input type='text' name='category_name' value='"+value+"'>\
              <button  type='submit'  name='category-submit'>Save</button>\
            </div>\
            </form>";

              var str = init_modal({
                title: "Edit Category",
                body: html,
                footer:""
              });

              $('.modal-container').find('.modal form').attr('modal-id',str);

        }
      }
      
   
      </script>
  




   
    
@stop
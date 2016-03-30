
@extends('user.master')
@section('content')

<div id="box">
<div class="box-top">User_Type_Details</div>
 <div class="box-top">Add New User</div>
           @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif

                  <div class="pull-right image">
                  
                  

                </div>
                </div>
            @foreach($news as $key)
   <table style="width:45%" class="table table-bordered table-striped table-hover table-responsive">
            <tr>
                <th colspan="1">Title</th>
                <td><?php echo $key->title; ?></td>
            </tr>
            <tr>
                <th colspan="1">Category</th>
               <td><?php echo $key->category->category_name; ?></td>
            </tr>
            <tr>
                <th colspan="1">Content</th>
                 <td><?php echo $key->body; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">Image</th>
              <td>  
             <img src="{{ $key->getImage() }}" class="img-circle" height="200" width="300"/>
              </td>
            </tr>
            <tr>
                <th colspan="1">Create_by</th>
                 <td><?php echo $key->create_by; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">By_admin</th>
                 <td><?php echo $key->by_admin; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">edit_by</th>
                 <td><?php echo $key->edit_by; ?></td>
              
            </tr>
             <tr>
                <th colspan="1">Status</th>
                 <td><?php echo $key->status; ?></td>
                
            </tr>
           
         <tr>
                <th colspan="1">Action</th>
                <td ><a href="{{ url( 'User/editnews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Edit </button></a>
                <a class="deletenews" data-id="{{ $key->news_id }}" href="{{ url( 'User/deletenews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Delete </button></a></td>
            </tr>
    
              </table>
    @endforeach
     </div>
     <script src="{{asset('resources/assets/js/jquery.js')}}"></script> 
      <script src="{{asset('resources/assets/js/jquery.validate.js')}}"></script>
      <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script> 
  
    <script type="text/javascript">
    
        jQuery(document).ready(function(){ 

      $(document).on('click','.deletenews', function(e){
        e.preventDefault();
       $this = $(this);
       var form = $(this);
       var url = $(this).attr('href');
      var table = $(this).closest('table')
        $.ajax({
          url:url,
          type:'get',
          datType:"json",
          success:function(res)
          {
              table.fadeOut(400);
            if(res)
            {
            init_modal({
            title: 'Delete News',
            body: 'News delete sucessfully',
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




    </script>
    @stop
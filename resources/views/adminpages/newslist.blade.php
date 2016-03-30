
@extends('try.index')
@section('title')
Newslist
@stop
 @section ('content')
 <div class="pageheader">
      <h2><i class="fa fa-user"></i> News List </span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here login:</span>
      </div>
    </div>
@stop
           @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
  @section('main')
      
  
   @foreach(array_chunk($news->all(),3) as $row)
   <div class="row">
   @foreach($row as $key)
        <div class="col-md-4">
        <h2><?php echo $key->title; ?></h2>
          <img src="{{ $key->getImage() }}" height="100" width="100"/>
       <div class="body"> {!!str_limit($key->body,50)!!} </div>
       <a href="{{ url( 'admin/editnews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Edit </button></a>
      <a class="deletenews" data-id="{{ $key->news_id }}" href="{{ url( 'User/deletenews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Delete </button></a>
       </div>
    @endforeach
    
                 </div>

      @endforeach
      <?php echo $news->render() ?>
    
     
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
   {{--  <tr>
                <th colspan="1">Action</th>
                <td ><a href="{{ url( 'User/editnews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Edit </button></a>
                <a class="deletenews" data-id="{{ $key->news_id }}" href="{{ url( 'User/deletenews/'. $key->news_id) }}" ><button class="btn btn-xs btn-primary"> Delete </button></a></td>
            </tr> --}}
@extends('try.index')
@section('title')
userlist
@stop
   @section ('content')
 <div class="pageheader">
      <h2><i class="fa fa-user"></i> User List </span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here login:</span>
      </div>
    </div>
@stop


@section('main')
 <div class="contentpanel">

      <div class="mb30"></div>
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif

      <div class="people-list">
        <div class="row">
          @foreach($user as $use)
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
                <a href="#" class="pull-left">
                  <img alt="" src="{{$use->getImage()}}" class="thumbnail media-object">
                </a>
                <div class="media-body">
                  <h4 class="person-name">{{ $use->firstname }}   {{ $use->lastname }}</h4>
                  <div class="text-muted"><i class="fa fa-map-marker">Address</i><a href="#">{{ $use->address }} </a></div>
                  <div class="text-muted"><i class="fa fa-briefcase"></i> Contact <a href="#">{{ $use->contact }}</a></div>
                  <div class="text-muted"><i class="fa fa-user"></i> User_type <a href="#">{{ $use->user_type }}</a></div>
                  <div class="text-muted"><i class="fa fa-envelope"></i> Email <a href="#">{{ $use->email }}</a></div>

                  <td><i class="fa fa-check"></i><a href="{{ url('admin/approved/'.$use->user_id) }}">Approved</a></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                   <td><i class="fa fa-edit"></i> <a href="{{ url('admin/editreporter/'.$use->user_id) }}">Update</a></td>

                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <td><i class="fa fa-times"></i><a href="{{ url('admin/deleteuser/'.$use->user_id) }}">Delete</a></td>
                   <div class="assigned_cat_list_holder">
                      @if($use->isRepoter() )
                        <a data-user-id="{{$use->user_id}}" href="" class="btn btn-primary assign_category">Assign Category</a>
                        @if(is_object($use))
                          <div class="assigned_cat_list">
                        @foreach($use->categories as $category)
                          <span class="label label-primary">{{$category->category_name}}</span>
                          @endforeach
                        </div>
                        @endif
                      @endif
                   </div>
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          @endforeach

        </div><!-- row -->
      </div><!-- people-list -->

    </div><!-- contentpanel -->




              <?php echo $user->render() ?>
              </div>
            </div>
@stop

@section('script')
  <script>
    $(document).on('ready',function(){
        $('.assign_category').on('click',function(e){
            e.preventDefault()
            var categories = JSON.parse('{!! App\category::select('category_name','category_id')->get() !!}')
            var html = "<div class='panel panel-primary'>\
                        <div class='panel-heading'>Select Categories</div>\
                        <div class='panel-body'>\
                        <ul class='main-list' data-user-id="+$(this).attr('data-user-id')+" class='list-group'>";
            $.each(categories, function(key, value){
              html+="<li class='list-group-item' data-category-id="+value.category_id+"><a href='' class='select-cat'>"+value.category_name+"</a></li>"
            })
            html +="</ul></div>";

            init_modal({
              "title" : "Assign Category To User",
              'body' : html,
              'footer' : ''
            })
        });

        $(document).on('click','.select-cat',function(e){
          e.preventDefault()
          var userId = $(this).closest('ul').attr('data-user-id')
          var catId = $(this).parent('li').attr('data-category-id')
          $this = $(this)
          $.ajax({
            type:'get',
            url: "{{url("/")}}/"+'assign/category/'+catId + '/user/'+userId,
            dataType: 'json',
            success: function(data){

                feedback('Succesfully assigned')
                  $this.next('.assigned_cat_list').append('<span class="label label-primary">'+$this.text()+'</span>')

            },
            error: function(data){
              feedback('Error')

            }
          })
        })
    });

    function feedback(message){
      console.log('ok')
        $('.modal').modal('hide');
        setTimeout(function(){
          init_modal({
            title:'',
            body:message,
            footer:''
          })
        },400)
    }
  </script>
@stop

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
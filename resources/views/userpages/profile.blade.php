
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
                  
                  <img src="{{ Auth::user()->getImage() }}" class="img-circle" height="200" width="300"/>

                </div>
                </div>
   <table style="width:45%" class="table table-bordered table-striped table-hover table-responsive">
            <tr>
                <th colspan="1">First Name</th>
                <td><?php echo $user->firstname; ?></td>
            </tr>
            <tr>
                <th colspan="1">Last Name</th>
               <td><?php echo $user->lastname; ?></td>
            </tr>
            <tr>
                <th colspan="1">Gender</th>
                 <td><?php echo $user->gender; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">Address</th>
               <td><?php echo $user->address; ?></td>
            </tr>
            <tr>
                <th colspan="1">Phone</th>
                 <td><?php echo $user->contact; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">Email</th>
                 <td><?php echo $user->email; ?></td>
              
            </tr>
             <tr>
                <th colspan="1">Status</th>
                 <td><?php echo $user->status; ?></td>
                
            </tr>
            <tr>
                <th colspan="1">Image</th>
                 <td><?php echo $user->image; ?></td>
              
            </tr>
            <tr>
                <th colspan="1">User_Type</th>
                 <td><?php echo $user->user_type; ?></td>
            </tr>
         <tr>
                <th colspan="1">Action</th>
                <td><a href="{{ url('User/editprofile/'. Auth::user()->user_id) }}" ><button class="btn btn-xs btn-primary">Edit </button></a>
            </tr>
    
  
              </table>
              
              </div>
    @stop


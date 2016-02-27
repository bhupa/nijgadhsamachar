@extends('user.master')
@section('content')
   <h1>DashBoard</h1>
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

<div id="box">
<div class ="box-top">Total_number_of_user</div>
</div>

<table class="table">
            <tr>
                <td>#ID</td>
                <td>Firstname</td>
                <td>lastname</td>
                 <td>Gender</td>
                  <td>Address</td>
                   <td>Phone</td>
                   <td>Email</td>
                   <td>Status</td>
                    <td>By_Admin</td>
            </tr>
            <?php foreach ($user as $key) { ?>
                <tr class="warning"></tr>
                  <td><?php echo $key->user_id; ?></td>
                    <td><?php echo $key->firstname; ?></td>
                    <td><?php echo $key->lastname; ?></td>
                     <td><?php echo $key->gender; ?></td>
                      <td><?php echo $key->address; ?></td>
                       <td><?php echo $key->contact; ?></td>
                        <td><?php echo $key->email; ?> </td> 
                        <td><?php echo $key->status; ?></td>
                        <td><?php echo $key->by_admin; ?></td>
                          <td><button type="button" class="btn btn-success"> <a href="{{ url('admin/approved/'.$key->user_id) }}"><strong>Approve</strong></button></td>
                           <td><button type="button" class="btn btn-success"> <a href="{{ url('admin/editreporter/'.$key->user_id) }}"><strong>Update</strong></button></td>
                           <td><button type="button" class="btn btn-success"> <a href="{{ url('admin/deleteuser/'.$key->user_id) }}"><strong>Delete</strong></button></td>

                </tr>
            <?php } ?>
              </table>
   
@stop
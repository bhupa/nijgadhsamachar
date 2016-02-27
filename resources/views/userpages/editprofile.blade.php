
@extends('user.master')
@section('content')
<div id="box">
      <div class="box-top">Edit_User</div>

<form method="POST" id="editprofile" action="{{ url('User/storeprofile/'. Auth::user()->user_id) }}" enctype="multipart/form-data" accept="image/gif,image/jpeg">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    
<div class="form-group">
    <label for="firstname">First_Name</label>
    <input name="firstname"class="form-control" value="<?php echo $user->firstname; ?>" type="text" id="firstname">
  </div>
  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('firstname') }}</div>
  <div class="form-group">
    <label for="lastname">Last_Name</label>
    <input name="lastname" class="form-control" value="<?php echo $user->lastname; ?>" id="lastname">
  </div>
  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('lastname') }}</div>
   <div class="form-group">
  <label for="select">Gender:</label>
  <select  name="gender"  class="form-control" id="select" type="gender">
    <option value="Male" <?php echo ($user->gender == 'Male') ? 'selected="selected"' : ''; ?>>Male</option>
<option value="Female" <?php echo ($user->gender == 'Female') ? 'selected="selected"' : ''; ?>>Female</option>
  </select>
</div>
 <div class="error" style="color:red; font-size:15px;">{{ $errors->first('gender') }}</div> 
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" value="<?php echo $user->address; ?>"  id="address">
  </div>
  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('address') }}</div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input  name="contact" type="tel" class="form-control" value="<?php echo $user->contact; ?>"  id="phone">
  </div> 
  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('contact') }}</div>
  
  <div class="form-group">
  <label for="image">Images</label>
    <td><input type="file" name="image" id="image">
    <img src="{{ Auth::user()->getImage() }}" class="img-circle" height="200" width="300"/></td>
    </div>
     <div class="error" style="color:red; font-size:15px;">{{ $errors->first('image') }}</div>
        
  <div class="form-group">
    <label for="email">Email address:</label>
    <input name="email"class="form-control" value="<?php echo $user->email; ?>" size="50" id="email">
     <div class="error" style="color:red; font-size:15px;">{{ $errors->first('email') }}</div>
  </div>

   <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
  <button type="submit" class="btn btn-primary" name="submit_edit_user"  value="submit">Submit</button>
</form>

    @stop

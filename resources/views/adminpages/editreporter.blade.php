
@extends('user.master')
@section('content')
<div id="box">
      <div class="box-top">Edit_User</div>
      @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

<form method="POST" id="editprofile" action="{{ url('admin/storereporter/'. Auth::user()->user_id) }}" enctype="multipart/form-data" accept="image/gif,image/jpeg">
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
  <label for="select">User_Type</label>
  <select  name="user_type"  class="form-control" id="select" type="gender">
    <option value="Admin" <?php echo ($user->gender == 'Admin') ? 'selected="selected"' : ''; ?>>Admin</option>
<option value="Reporter" <?php echo ($user->gender == 'Reporter') ? 'selected="selected"' : ''; ?>>Reporter</option>
  </select>
</div>
 <div class="error" style="color:red; font-size:15px;">{{ $errors->first('user_type') }}</div> <div class="form-group">
  <label for="select">Status</label>
  <select  name="status"  class="form-control" id="select" type="gender">
    <option value="Active" <?php echo ($user->status == 'Active') ? 'selected="selected"' : ''; ?>>Active</option>
<option value="Postponed" <?php echo ($user->status == 'Postponed') ? 'selected="selected"' : ''; ?>>Postponed</option>
 <option value="Expired" <?php echo ($user->status == 'Expired') ? 'selected="selected"' : ''; ?>>Expired</option>
 <option value="Dimissed" <?php echo ($user->status == 'Dimissed') ? 'selected="selected"' : ''; ?>>Dimissed</option></select>
</div>
 <div class="error" style="color:red; font-size:15px;">{{ $errors->first('status') }}</div> 

 <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" value="<?php echo $user->address; ?>"  id="address">
  </div>
  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('address') }}</div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input  name="contact" type="tel" class="form-control" value="<?php echo $user->contact; ?>"  id="phone">
  </div> 
 <div class="form-group">
    <label for="phone">By_admin</label>
    <input  name="by_admin" type="tel" class="form-control" value="<?php echo $user->by_admin; ?>"  id="by_admin">
  </div> 

  <div class="error" style="color:red; font-size:15px;">{{ $errors->first('by_admin') }}</div>
  
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

   <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
  <button type="submit" class="btn btn-primary" name="submit_edit_user"  value="submit">Submit</button>
</form>

    @stop

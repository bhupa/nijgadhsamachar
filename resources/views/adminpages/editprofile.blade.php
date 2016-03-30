
@extends('try.index')
@section('title')
viewprofile
@stop

@section ('content')
 <div class="pageheader">
      <h2><i class="fa fa-user"></i> Edit Profile </span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here login:</span>
      </div>
    </div>
@stop
@section('main')
@if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
<div class="contentpanel">
      
      <div class="row">
        <div class="col-sm-3">
          <img src="{{ Auth::user()->getImage() }}" class="thumbnail img-responsive" alt="" />
          
          <div class="mb30"></div>
          
          <h5 class="subtitle">Connect</h5>
          <ul class="profile-social-list">
            <li><i class="fa fa-twitter"></i> <a href="#">twitter.com/eileensideways</a></li>
            <li><i class="fa fa-facebook"></i> <a href="#">facebook.com/eileen</a></li>
            <li><i class="fa fa-youtube"></i> <a href="#">youtube.com/eileen22</a></li>
            <li><i class="fa fa-linkedin"></i> <a href="#">linkedin.com/4ever-eileen</a></li>
            <li><i class="fa fa-pinterest"></i> <a href="#">pinterest.com/eileen</a></li>
            <li><i class="fa fa-instagram"></i> <a href="#">instagram.com/eiside</a></li>
          </ul>
          
          <div class="mb30"></div>
          
          <h5 class="subtitle">Contact</h5>
          <address>
          <?php echo $user->address; ?>
            <?php echo $user->contact; ?>
             <?php echo $user->email; ?>
          </address>
          
        </div><!-- col-sm-3 -->
        <div class="col-sm-9">
          
          <div class="profile-header">
            <h2 class="profile-name"><?php echo $user->firstname; ?></h2>
            <div class="profile-location"><i class="fa fa-map-marker"></i><?php echo $user->address; ?></div>
            <div class="profile-position"><i class="fa fa-briefcase"></i> {{ Auth::user()->getUser_type() }} <a href="#">NijgadhSamachar, Inc.</a></div>
            
            <div class="mb20"></div>
            
            <button class="btn btn-success mr5"><i class="fa fa-user"></i> Follow</button>
            <button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>
          </div><!-- profile-header -->
          
          <!-- Nav tabs -->
        
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            
               <div class="row">
            
            
                
                <form method="post" id="edituser" action="{{ URL::to('admin/storeprofile/'.Auth::user()->user_id) }}" 
              enctype="multipart/form-data" accept="image/gif,image/jpeg">
                    
                    <div class="mb10">
                        <label for="firstname" class="control-label">First_Name</label>
              <input name="firstname"class="form-control" type="text" id="firstname" value="<?php echo $user->firstname; ?>">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('firstname') }}</div>
                    </div>
                  <div class="mb10">
                    <label for="lastname">Last_Name</label>
              <input name="lastname" class="form-control" id="lastname" value="<?php echo $user->lastname; ?>">
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('lastname') }}</div>
                    </div>
                    <div class="mb10">
                    <label for="select">Gender:</label>
             <select  name="gender"  class="form-control" id="gender" type="gender" size="1">
                <option value="Male" <?php echo($user->gender == 'Male') ?'selected="selected"':'';?>>Male</option>
                <option value="Female" <?php echo ($user->gender == 'Female') ?'selected= "selected"':''; ?>>Female</option>
             </select>
             <div class="error" style="color:red; font-size:15px;">{{ $errors->first('gender') }}</div>   
                    </div>
                    <div class="mb10">
                     <label for="select">User_Type</label>
              <select  name="user_type"  class="form-control" id="user_type" type="user_type" size="1"> 
                  <option value="Admin" <?php echo ($user->user_type == 'Admin') ?'selected ="selected"':''; ?> >Admin</option>
                  <option value="Reporter" <?php echo ($user->user_type =='Reporter')?'selected ="selected"':''; ?>>Reporter</option>
              </select>
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('user_type') }}</div>
   
                    </div>
                    <div class="mb10">
                      <label for="address">Address</label>
            <input type="text" class="form-control" name="address"  id="address" value="<?php echo $user->address;?>">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('address') }}</div>

                    </div>
                    <div class="mb10">
                    <label for="phone">Phone</label>
            <input  name="contact" type="number" class="form-control"  id="phone" value="<?php echo $user->contact; ?>">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('contact') }}</div>
                    </div>
                    <div class="mb10">
                    <label for="image">Images</label>
              <input type="file" name="image" id="image"   value="<?php echo $user->image; ?>" >
              <img src="{{ Auth::user()->getImage() }}" class="img-circle" height="100" width="200"/>

            <div class="error" style="color:red; font-size:15pxo">{{ $errors->first('image') }}</div>
                    </div>
                    <div class="mb10">
                     <label for="email">Email address:</label>
            <input name="email"class="form-control" size="50" id="email" value="<?php echo $user->email; ?>">
            <div class="error" style="color:red; font-size:15px;">{{ $errors->first('email') }}</div> 
                    </div>
                    
                   <div class="mb10">
                     <label for="select" >Status</label>
                     <select  name="status"  class="form-control"  size="1" type="status"> 
                  <option value="Active" <?php echo ($user->status == 'Active') ?'selected ="selected"':''; ?>>Active</option>
                  <option value="Expired" <?php echo ($user->status =='Expired')?'selected ="selected"':''; ?>>Expired</option>
                  <option value="Dimissed" <?php echo ($user->status =='Dimissed')?'selected ="selected"':''; ?>>Dimissed</option>
                  <option value="Postponed" <?php echo ($user->status =='Postponed')?'selected ="selected"':''; ?>>Postponed</option>
              </select>
              
              <div class="error" style="color:red; font-size:15px;">{{ $errors->first('status') }}</div>
   </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                    
                  
                    <br />
                    
                    <button class="btn btn-success btn-block">Sign Up</button>     
                </form>
            </div><!-- col-sm-6 -->
            
        </div><!-- row -->
            

        
    </div><!-- tab-content -->
  </div><!-- rightpanel -->
  
</section>

<script>
  jQuery(document).ready(function(){
    
    $(document).on('submit','.edituse', function(e){
        e.preventDefault();
        alert('hello');
    });




</script>


    @stop


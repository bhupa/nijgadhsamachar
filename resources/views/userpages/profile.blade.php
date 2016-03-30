
@extends('try.index')
@section('title')
viewprofile
@stop

@section ('content')
 <div class="pageheader">
      <h2><i class="fa fa-user"></i> Profile </span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here login:</span>
      </div>
    </div>
@stop
@section('main')

<div class="contentpanel">
      
      <div class="row">
        <div class="col-sm-3">
          <img src="{{ Auth::user()->getImage() }}" class="thumbnail img-responsive"  />
          
        
          <div class="mb30"></div>
          <h5 class="subtitle">About</h5>
          <p class="mb30">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat... <a href="#">Show More</a></p>
          
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
            <div class="activity-list">
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
                <td><a class="edituser" href="{{ url('admin/editprofile/'. Auth::user()->user_id) }}" ><button class="btn btn-xs btn-primary">Edit </button></a></td>
            </tr>
    
  
              </table>
             
                  </div><!-- media -->
                
  </div>
</section>


 @stop




   


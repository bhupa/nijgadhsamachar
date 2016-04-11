@extends('try.index')
@section('title')
UserSignIn
@stop
@section('main')
     @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
            @endif
<?php 
    $query = new App\User;
    $query = $query->newQueryWithoutScopes();
    $email = $query->from('password_resets')->where('token',$token)->first()->email;
?>
<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> bracket <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Welcome to Bracket Bootstrap 3 Template!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="signup.html">Sign Up</a></strong>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
              <form method="POST" action="{{ url('password/reset/'.$token) }}">
                    <h4 class="nomargin">Forget Password</h4>
                    <p class="mt5 mb20">Please Make you password strong Example abc123@.com</p>
                
                    
                    <input type="password" class="form-control pword" name="password" placeholder="Password" />
                    <span style="color:red; font-size:15px;">{{ $errors->first('password') }}</span></br>
                     <input type="password" class="form-control confpword" name="password_confirmation" placeholder="Confrim_Password" />
                    <span style="color:red; font-size:15px;">{{ $errors->first('password_confirmation') }}</span></br>
                    <input type="hidden" name="email" value="{{$email}}">
                    <button type="submit" class="btn btn-success btn-block">Save</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy: 2014. All Rights Reserved. Bracket Bootstrap 3 Admin Template
            </div>
            <div class="pull-right">
                Created By: <a href="http://themepixels.com/" target="_blank">ThemePixels</a>
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>
@stop
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
                
              <form method="POST" action="{{ url('/auth/login') }}">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <input type="text" class="form-control uname" name="email" placeholder="Username" />
                    <span style="color:red; font-size:15px;">{{ $errors->first('email') }}</span>
                    <input type="password" class="form-control pword" name="password" placeholder="Password" />
                    <span style="color:red; font-size:15px;">{{ $errors->first('password') }}</span></br>
                    <a href="#"><small>Forgot Your Password?</small></a>
                    <button class="btn btn-success btn-block">Sign In</button>
                    
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
  {{--  <form method="POST" action="{{ url('/auth/login') }}">
    {!! csrf_field() !!}
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                         </div>
                         <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit"name="submit_login" id="login" class="btn btn-info">Submit</button>
            </form> --}}
            </div>
</section>
@stop
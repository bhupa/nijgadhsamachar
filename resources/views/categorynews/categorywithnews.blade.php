<!DOCTYPE html>
<html>
    <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>NijgadhSamachar</title>
              <link href="{{asset('resources/assets/css/bootstrap.min.css')}}" rel="stylesheet">
              <link href="{{asset('resources/assets/css/style.css')}}" rel="stylesheet">
              <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
              <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
    <div class="container"><img src="{{asset('resources/assets/images/logo.jpg')}}"></div>

        <div class="container"> 
          <div class="navbar navbar-inverse  ">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav navbar-right " >
                       <li class="active"><a href="#">Navigation bar</a></li>
                       <li class="active"><a href="#">Home</a></li>
                       <li ><a href="#">About</a></li>
                       
  

                       @if( !Auth::user() )
                           <li ><a href="{{ url('auth/login') }}">Login</a></li>
                       @endif

                      @if( Auth::user() )
                           <li ><a href="{{ url('auth/logout') }}">Logout</a></li>
                       @endif


                       <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown">sports<span class="caret"></span></a>
                
                <ul class="dropdown-menu" >
                          <li><a href="#">FOOTBALL</a></li>
                          <li class="divider"></li>
                           <li ><a href="#">CRICKET</a></li>
                           <li class="divider"></li>
                            <li ><a href="#">RUGBY</a></li> 
                              <li class="divider"></li>
                             <li> <a href="#">sports</a></li>

                </ul>
                </li>
                </ul>
                     
              </div>
            </div>

        </div>
        <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
       
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox" style="float:center">
    <div class="item active">
     <img src="{{asset('resources/assets/images/50.jpg')}}">
    </div>

    <div class="item">
      <img src="{{asset('resources/assets/images/shiva.jpg')}}">
    </div>

    <div class="item">
       <img src="{{asset('resources/assets/images/banner.jpg')}}">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> </div>
<div class="container" >
  <div class="row">
    <div class="col-lg-9" style="background-color:yellow;" >
    <div class="conatiner">Main News</div>
    <div class="col-lg-9">
    <table class="table border_bottom">
     @foreach($allNews as $news)
      <tr>
          <td> <img src="{{$news->getImage()}}" class="img-responsive"></td>
          <td>{{ $news->news_title }}</td>
          <td><p>{{ $news->body }}</p><a class="btn btn-default" >By {{ $news->category->category_name }}</a></td>
      </tr>
      @endforeach
   
  </table>
</div>
    
    </div>
    <div class="col-lg-3" style="background-color:pink;">
     <div class="conatiner">Nijgadh Samachar</div>
    </div>
  </div>


</div>


 <script src="{{asset('resources/assets/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    </body>
</html>

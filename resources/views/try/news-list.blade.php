 @extends('try.index')
 @section('title')
  News List
 @stop

 @section('main')
 <div class="contentpanel">
      
      <div class="mb30"></div>
      
      <div class="people-list">
        <div class="row">
          @foreach($news as $new)
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
                <a href="#" class="pull-left">
                  <img alt="" src="{{$new->getImage()}}" class="thumbnail media-object">
                </a>
                <div class="media-body">
                  <h4 class="person-name">{{ $new->title }}</h4>
                  <div class="text-muted"><i class="fa fa-map-marker"></i> Cebu City, Philippines</div>
                  <div class="text-muted"><i class="fa fa-briefcase"></i> Software Engineer at <a href="#">SomeCompany, Inc.</a></div>
                  
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          @endforeach
          
        </div><!-- row -->
      </div><!-- people-list -->
      
    </div><!-- contentpanel -->

    @stop
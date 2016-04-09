@extends('newpages/newshome')
@section('content')
<div>
<div class="row">
  @foreach($allNews as $news)
      <div class="col-md-3 panel panel-default" style="border:1px solid #ccc;margin:0px">
        <h4 class="panel-heading">{{ucfirst($news->title)}}</h4>

        <div class="panel-body">
            <img class="img-responsive" src="{{$news->getImage()}}">
        </div>
        <br>
        <span class="label label-success">{{ $news->category->category_name }}</span>
        <br>
        {!! str_limit($news->body) !!}
        <div><a href="{{url('news/'.$news->news_id)}}" class="btn btn-primary">Read More</a>
             <a herf="" data-news-id='{{ $news->news_id }}' class="btn btn-success comment"><i class="fa fa-comment"></i></a>
        </div>

      @if(!$news->comments->isEmpty() )
        <div>
            Comments
        </div>
        @endif

          <ul class="list-group">
              @foreach($news->comments as $comment)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <img class="img-responsive" src="{{$comment->user->getImage()}}">
                        </div>
                        <div class="col-md-9">

                            {{$comment->content}}
                        </div>
                      </div>
                </li>
              @endforeach
          </ul>
</div>
          @endforeach
  </div>
</div>
@stop

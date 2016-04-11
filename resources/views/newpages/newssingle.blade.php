@extends('newpages/newshome')
@section('content')
  <div>

<div class="separator"></div>
      <div class="row">

          <div class="col-md-8 panel panel-default" style="box-shadow:-1px 1px 6px 3px rgba(0,0,0,0.3);margin:0px">
              <h4 class="panel-heading">{{ucfirst($news->title)}}</h4>

              <div class="panel-body"><div class="">
                  <img class="img-responsive" src="{{$news->getImage()}}">
              </div>
              <br>
              <span class="label label-success">{{ $news->category->category_name }}</span><br>
              <br>
              {!! $news->body !!}
              <br>
              <br>
              <div><a class="btn btn-primary">Read More</a>
              <a herf="" data-news-id='{{ $news->news_id }}' class="btn btn-success comment"><i class="fa fa-comment"></i></a>
            </div>
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
                              <div class="col-md-1">
                                <img class="img-responsive" src="{{$comment->user->getImage()}}">
                              </div>
                              <div class="col-md-11">

                                  {{$comment->content}}
                              </div>
                            </div>
                      </li>
                    @endforeach
                </ul>

          </div>
          </div>
      <div class="divider"></div>
      <br>
      <div class="row">
     
      <div class="panel panel-primary">
          <div class="panel-body">
            <div class="row">
            @foreach($categorynews as $news)
              <div class="col-md-4 panel panel-default">
                  <h4 class="panel-heading">{{$news->title}}</h4>
                  <div class="panel-body">
                    <div class="">
                        <img class="img-responsive" src="{{$news->getImage()}}">
                    </div>
                    <br>
                    {!! str_limit($news->body) !!}

                    <div><a href="{{url('news/'.$news->news_id)}}" class="btn btn-primary">Read More</a>
                  </div>
              </div>
            </div>
              @endforeach
          </div>
      </div>
    </div>
</div>
      </div>
@stop
@section('script')
  <script>
    $(document).on('ready',function(){
        $('.comment').on('click', function(e){
            e.preventDefault();
              @if(Auth::check())
              var newsId = $(this).attr('data-news-id')
                init_modal({
                  title: "Add A Comment",
                  body: "<form class='add-comment' data-news-id="+newsId+"><div class='form-group'><input type='text' class='form-control' name='comment'></div></form>",
                  footer:''
                })
              @else
                init_modal({
                  title: "Please Login",
                  body: "Click On Login Button to login",
                  footer: "<a href='{{ ('User/login') }}' class='btn btn-primary'>Login</a>",
                })
              @endif;

        })

          $(document).on('submit','.add-comment',function(e){
            e.preventDefault()
              var data = $(this).serialize();
              $.ajax({
                url: "{{ url('add/comment') }}" + '/' + $(this).attr('data-news-id'),
                type: 'POST',
                data: data + '&_token={{csrf_token()}}',
                dataType: 'json',
                success:function(response){
                  location.reload()
                }
              })
          })
    })
  </script>
@stop

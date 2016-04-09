@extends('newpages/newshome')
@section('content')
  <div>
      <h3>Latest News</h3>
<div class="separator"></div>
      <div class="row">
        @foreach($latestNews as $news)
            <div class="col-md-3 panel panel-default" style="border:1px solid #ccc;margin:0px">
              <h4 class="panel-heading">{{ucfirst($news->title)}}</h4>

              <div class="panel-body">
                  <img height="200" width="200" class="img-responsive" src="{{$news->getImage()}}">
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
                 <a href="" class="toggle-comment "> Comments</a>
              </div>
              @endif

                <ul class="list-group" style="display:none;">
                    @foreach($news->comments as $comment)
                      <li class="list-group-item">
                          <div class="row">
                              <div class="col-md-3 col-xs-3">
                                <img class="img-responsive" src="{{$comment->user->getImage()}}">
                              </div>
                              <div class="col-md-9">

                                 <span class="comment-text"> {{$comment->content}}</span>
                                  @if (Auth::check() && Auth::user()->user_id==$comment->user_id)
                                 
                                   <a style="padding-left: 15px;" herf="" data-comment-id='{{ $comment->comment_id }}' class="deletecomment pull-right"><i class="glyphicon glyphicon-remove-sign"></i></a>
                                    <a  herf="" data-comment-id='{{ $comment->comment_id }}' class="editcomment pull-right"><i class="glyphicon glyphicon-pencil"></i></a>
                                  @endif
                              </div>
                            </div>
                      </li>
                    @endforeach
                </ul>
</div>
                @endforeach
        </div>
      </div>
      <div class="divider"></div>
      <br>
<div class="row">
      @foreach($categoryNews as $category)
      <div class="panel panel-primary">
          <h4 class="panel-heading">
            {{ $category->category_name }}
          </h4>
          <div class="panel-body">
            <div class="row">
            @foreach($category->news as $news)
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
      @endforeach
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
                  body: "<form class='add-comment'  data-news-id="+newsId+"><div class='form-group'><input type='text' class='form-control' name='comment'></div>\
                  <div><button class = 'btn btn-default' type='submit'>Save</button></div></form>",
                  footer:''
                })
              @else
                init_modal({
                  title: "Please Login",
                  body: "<form class='login' method='POST' action='{{ url('auth/login') }}'>\
                   <input type='hidden' name='_token' id='_token' value='{{ csrf_token() }}'>\
                  <div><label for='email'>Email</label><input type='text' class='form-control' name='email'></div>\
                  <div class='form-group'><label for='Password'>Password</label><input type='password' class='form-control' name='password'></div>\
                  <div><button class='btn btn-primary' type='submit'> Login</button>'</div>\
                  </form>",
                  footer: "<a href='' class='btn btn-primary'>Forget Password</a>",
                })
              @endif;

        })
        // this function is for edit the comment 
        $(document).on('click','.editcomment',function(e){

          e.preventDefault()
           $this=$(this);
          var comment = $this.closest('.list-group-item').find('.comment-text');
          var commentText = comment.text();

          var  commentForm = "<form class='edit-comment' data-comment-id='"+$this.attr('data-comment-id')+ "'>\
          <input type='text' class='form-control' name='comment' value='"+ commentText +"'></input>\
          </form>";

          comment.html(commentForm)

        });
        $(document).on('submit','form.edit-comment',function(e){
          $this = $(this)
          e.preventDefault()
           var data = $(this).serialize();
              $.ajax({
                url: "{{ url('edit/comment') }}" + '/' + $(this).attr('data-comment-id'),
                type: 'POST',
                data: data + '&_token={{csrf_token()}}',
                dataType: 'json',
                success:function(response){
                 var newComment = response.status;
                  $this.parent('.comment-text').html(newComment)
                }
              })
        

        });


        // this function is for delete the comment 
        $(document).on('click','.deletecomment',function(e){
          e.preventDefault()
          $this=$(this);
          var data = $(this).serialize();
             $.ajax({
              url:"{{ url ('delete/comment')}}"+'/'+$(this).attr('data-comment-id'),
              type:'get',
              dataType:'json',
              success:function(res)
                  {
                    if (res) 
                    {
                      
                     $this.closest('.list-group-item').slideUp(300);

                    }
                    else
                    {
                      alert('error');
                    }
                  } 

             });



        });
//  this function is for adding comment for the news
          $(document).on('submit','.add-comment',function(e){
            e.preventDefault()
              var data = $(this).serialize();
              $.ajax({
                url: "{{ url('add/comment') }}" + '/' + $(this).attr('data-news-id'),
                type: 'POST',
                data: data + '&_token={{csrf_token()}}',
                dataType: 'json',
                success:function(response){
                  $('.modal').modal('hide')
                  location.reload()
                }
              })
          })
    })
    $(document).on('click','.toggle-comment',function(e){
      e.preventDefault();
      $(this).parent().next('ul').slideToggle(300);
    });

    var d;
  </script>
@stop
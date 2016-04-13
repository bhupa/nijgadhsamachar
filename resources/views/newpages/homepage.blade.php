@extends('newpages/newshome')
@section('content')
<div class="container" style="min-height: 594px;">
 <div class="row">
    <div class="col-xs-12 col-md-8">
       @if (Session::has('flash_message'))
              <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
              </div>
       @endif
      </div></div> 
<div class="panel panel-primary">
          <h4 class="panel-heading">
            Latest News
          </h4>
           
<div class="panel-body">
      <div class="row news-list">
        @foreach($latestNews as $news)
            <div class="col-md-3 a-news-list panel panel-default">
              <h4 class="panel-heading">{{ucfirst($news->title)}}</h4>

              <div class="panel-body">
                  <img height="140" width="140" class="img-responsive" src="{{$news->getImage()}}">
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
                                <img  class="img-responsive" src="{{$comment->user->getImage()}}">
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
         <div class="divider" style="margin-bottom: 20px"></div>

      <br>
<div class="row">
      @foreach($categoryNews as $category)
      <div class="panel panel-primary" style="margin-bottom: 20px">
          <h4 class="panel-heading">
            {{ $category->category_name }}
          </h4>
          <div class="panel-body news-parent">
            <div class="row">
            @foreach($category->news as $news)
              <div class="cat-news-list col-md-3 news-child panel panel-default">
                  <h4 class="panel-heading">{{$news->title}}</h4>
                  <div class="panel-body">
                    <div class="">
                        <img height="140" width="140" class="img-responsive" src="{{$news->getImage()}}">
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
      </div>

    
    <div class="col-xs-6 col-md-4">
      One of three columns
    </div>
  </div>
</div>
@stop

@section('script')
  <script>
    $(document).on('ready',function()
    {

        $('.news-list').masonry({
          // options...
          itemSelector: '.a-news-list',
          columnWidth: 100
        });

        $('.news-parent').masonry({
          // options...
          itemSelector: '.news-child',
          columnWidth: 300
        });

        $(document).scroll()

        $(document).on('click','.comment', function(e)
        {
          console.log('Ok')
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

                <?php
                    Session::put('reffer', url(""));
                ?>

                init_modal({
                  title: "Please Login",
                  body: "<form class='login' method='POST' action='{{ url('auth/login') }}'>\
                   <input type='hidden' name='_token' id='_token' value='{{ csrf_token() }}'>\
                  <div><label for='email'>Email</label><input type='text' class='form-control' name='email'></div>\
                  <div class='error-holder'></div>\
                  <div class='form-group'><label for='Password'>Password</label><input type='password' class='form-control' name='password'></div>\
                  <div class='error-password'></div>\
                  <div><button class='btn btn-primary' type='submit'> Login</button>'</div>\
                  </form>",
                  footer: "<a href='' style='float:pull-left' class='btn btn-primary forget-password'>Forget Password</a><a href='{{ url('User/adduser')}}' class='btn btn-primary'>SingUp</a>",
                })
              @endif;

        });
        // forget password 
        $(document).on('click','.forget-password', function(e){
          e.preventDefault();

          $('.modal').modal('hide');

          setTimeout(function(){
            init_modal({
              title: 'Forget Password',
              body: '<form class="forget-password-form">Email<div class="form-group"><input type="email" class="form-control" name="email"></div><button type="submit" class="btn btn-default">Send Link</button></form>'
            })
          },500)

        });
        

        $(document).on('submit','.forget-password-form',function(e){
          e.preventDefault()
          var email = $(this).find('[name="email"]').val()
          var data = $(this).serialize();
          if( isEmail( email ) )
          {
            $.ajax({
              url : "{{url('password/email')}}",
              data : (data + '&_token={{csrf_token()}}'),
              type : 'post',
              dataType : 'json',
              accept : 'json',
              success : function(res)
              {

                $('.modal').modal('hide')
                   
                   setTimeout(function(){
                    init_modal({
                      title: 'SuccessFully Complete Operation',
                      body: 'Please check Your email'
                    })
                  },1000)

                console.log(res)
              }
            })  
          }
        })
       
        // server side login validation
        $(document).on('submit','.login', function(e){
          e.preventDefault();

           var email = $(this).find('[name="email"]').val();
           var password = $(this).find('[name="password"]').val();
           var error = false
           if(!isEmail(email))
           {
            error = true
              $(this).find('.error-holder').html('<span style="color:Red;">Invalid email  [please insert abc@xxx.com]</span>');
           }
           if($.trim(password) == '' )
           {
            error = true
            $(this).find('.error-holder').html('<span style="color:Red;">Please insert a password</span>');
           }

           if(error){
            return false;
           }

           $('.error-holder').html("")
          var data = $(this).serialize();
          $.ajax({
                url: "{{ url('ajax/login') }}",
                type: 'POST',
                data: data + '&_token={{csrf_token()}}',
                dataType: 'json',
                accept: 'json',
                success: function (res) {
           
              $('.modal').modal('hide');
              location.reload()
             },
             error:function(res)
                  {
                    
                    $('.modal').modal('hide')
                      setTimeout(function(){

                        notifier.errorNotify(res) 
                      },400) 

                  }
        });
              });


        });
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
          });
  
    $(document).on('click','.toggle-comment',function(e){
      e.preventDefault();
      $(this).parent().next('ul').slideToggle(300);
    });

    function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

var notifier =
{
errorNotify:function(res)
{
var error = res.responseJSON;
var modalData = {};
modalData.title = "Error !"
modalData.body ="<p style='color:red'>These are the following error:";
$.each(error, function(key, value)
{
modalData.body += "<p style='text-decoration:underline'>"+key+"</p>";
for(var i = 0; i < value.length; i++)
{
  modalData.body +=("<span>" +value[i]+"<span>");
}
});
modalData.footer="please make sure your input is correct";
init_modal(modalData);
}

}
  </script>
@stop

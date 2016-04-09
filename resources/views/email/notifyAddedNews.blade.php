<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notify</title>
  </head>
  <body>
      <div class="">
          <h4>
              A new News has been added
          </h4> on
          <a href="{{url($category->category_id.'/news')}}">{{ $category->category_name }} </a> by {{$auth_user->firstname}}
          <h5>{{$news->title}}</h5>
          <p>{{$news->body}}</p>

          Please Login and approve this news if this is valuable one.
      </div>
  </body>
</html>

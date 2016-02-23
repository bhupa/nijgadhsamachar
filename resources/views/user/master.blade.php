  <html lang="en">
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin Dashboard</title>
      <link href="{{asset('resources/assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('resources/assets/css/global.css')}}" rel="stylesheet">

    </head>
    <body>
    @include('userincludes.title')


   <div id="container">
        @include('userincludes.head')

  </div>

  <div class="content">

     @yield('content')

    </div>
    </div>

  <div id="footer">

    this is footer
     </div>
 <div class="modal-container"></div>
  <script type="text/javascript">
  function makerandom_str()
{

    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;

}

    function init_modal(content){

  var random_str = makerandom_str();
  var model_html = '<div tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade" id="'+random_str+'">';
  model_html += '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">';
  model_html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
  model_html += '<h4 class="modal-title panel-heading" id="myModalLabel">'+content.title+'</h4></div>';
  model_html += '<div class="modal-body">'+content.body+'</div>';
  model_html += '<div class="modal-footer">'+content.footer+'</div>';
  model_html += "</div>"; //model conten ends
  model_html += "</div>"; //model dialog ends
  model_html += "</div>" //model ends
  
  $('body').find('.modal-container').html(model_html);
  
  $('#'+random_str).modal('show');
    
    return random_str;
}
  </script>
  
  <!-- Include all compiled plugins (below), or include individual files as needed -->

</body>
</html>
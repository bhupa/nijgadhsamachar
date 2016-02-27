 @extends('user.master')

 @section('content')
   <h1> Edit Category</h1>
   @if (Session::has('flash_message'))
				<div class="alert alert-danger">
					{{ Session::get('flash_message') }}
				</div>
				@endif
        
              <form method="POST" id="category" action="{{ URL::to('admin/update_category/'.$category->category_id) }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
             
                        <div class="form-group">
                          <label for="Category">News Category</label>
                          <input type="text" class="form-control" name="category_name" id="category_name" value="{{$category->category_name}}" placeholder="category_name">
           
@if ($errors->has())
<p style="color:red; font-size:20px;">
  @foreach ($errors->all() as $error)
    {!! $error !!}<br />		
  @endforeach
</p>
@endif
                         </div>
                        <button type="submit"name="submit_login"  class="btn btn-info">Submit</button>
            </form>
    <div id="box">
      <div class="box-top">Category Table</div>
      
      <script src="{{asset('resources/assets/js/jquery.js')}}"></script> 
      <script src="{{asset('resources/assets/js/jquery.validate.js')}}"></script>
      <script src="{{asset('resources/assets/js/bootstrap.min.js')}}"></script> 
  
<script type="text/javascript">
    
    jQuery(document).ready(function(){
            $("#category").validate({
       rules: {
    category_name:{
      required: true
     
    }
  },
      submitHandler: function(form,event){
           event.preventDefault()
}
 
    });
      $('#category').on('submit',function(){
        $this = $(this);
        var d = $(this).data();
        if(!d.validator.valid()){
    return false;
  }

        var form = $(this);
        var url  = form.prop('action');
        
$.ajax
({

      url:url,
      type:"POST",
      async:"false",
      dataType: "json",
      processData: false,
      data:form.serialize(),
      success:function(re)
      {

                if (re == 0) 
                {

                  alert('Category Added Successfully');
                }
                else
                {

                  alert('error');
                }

      }

});
 

      });
    });


      
      
   
      </script>
  
      
@stop

            
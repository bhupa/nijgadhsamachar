@extends('user.master')
@section('content')
   <h1>DashBoard</h1>
         @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
             <form method="POST" action="{{ url('/auth/login') }}">
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
            </form>
    <div id="box">
      <div class="box-top">Admission</div>
      <table class="table table-bordered ">
            <tr class="active text-primary" style="background-color:yellow" >
              <td >Course</td><td>Session</td> <td>year</td> <td >Total_Seats</td><td>Remaining_Seats</td><td >Total_Scholarship</td><td >Reamining_Scholarship</td>
            </tr>
            <tr>
              <td>BBA</td><td>Autum</td><td>2016</td><td>70</td> <td>40</td><td>10</td>
              <td>3</td>
            </tr>
            <tr>
              <td>O$A LEVEL</td><td>Autum</td> <td>2016</td><td>40</td><td>20</td><td>10</td>
              <td>3</td>
            </tr>
            <tr>
              <td>IT</td> <td>Autum</td><td>2016</td><td>70</td><td>40</td><td>10</td><td>3</td>
            </tr> 
      </table>
@stop
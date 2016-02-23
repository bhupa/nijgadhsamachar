<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;
use App\Http\Requests\UserRequest;
use App\User;


class UserController extends Controller
{

    public function index()
	{
		return view('userpages/home');
	} 
	
	 public function adduser()
	{
		
		return view('userpages/register');
	} 
	
	 public function storeuser(UserRequest $request)
	{
       $input = $request->all();
       $input['password'] = \Hash::make($input['password']);
		$nepal = User::create($input);
		return Redirect::to('User/adduser')
 			->withFlashMessage('sucessfully create');
	} 
}

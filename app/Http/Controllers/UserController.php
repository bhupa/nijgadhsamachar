<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;
use App\Http\Requests\CreateUserRequest;
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
	public function viewprofile($user)
	{
		return view('userpages/profile')->withUser($user);
	} 

	public function editprofile( $user)
	{
    return view('userpages/editprofile')->withUser($user);
	}
	
	 public function storeuser(CreateUserRequest  $request)
	{
       $input = $request->all();
       $file = $request->file('image');
       $imageName = $this->saveImage($file);
       $input['password'] = \Hash::make($input['password']);
		$nepal = User::create($input);
		$nepal->remember_token = md5(time());
		$nepal->image = $imageName;
		$nepal->save();
		return Redirect::to('User/adduser')
 			->withFlashMessage('sucessfully create');
	} 


	public function saveImage($file){	
	

		$destinationPath =  public_path().'\images';

		$fileimgname = 'fileimg' . str_random(12);

		$extension = $file->getClientOriginalExtension();

		$destinationFilename = $fileimgname.'.'.$extension;

		$image_success = $file->move($destinationPath, $destinationFilename);

		return $destinationFilename;
	}
	public function storeprofile(CreateUserRequest  $request, $id) 
	{

		$user = \Auth::user();

		if($request->file('image')){
			$file = $request->file('image');
        	$imageName = $this->saveImage($file);
	        $user->image = $imageName;
		}

        $user->fill($request->all());
		
		$user->save();

		return Redirect::to('User/viewprofile/'.$id->user_id)
 			->withFlashMessage('sucessfully Edit');
	}
}

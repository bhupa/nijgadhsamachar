<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Session;
use App\Http\Requests\CreateUserRequest;
use App\User;

class AdminController extends Controller
{
    public function viewuser($user)
    {
return view('adminpages/userlist')->withUser($user->all());
    }
    public function approved($user)
    {
    	$user->by_admin = 1;
    	$user->save();
        return Redirect::to('admin/viewuser/'.$user->user_id)
 			->withFlashMessage('sucessfully approved');
    }
    public function deleteuser($user)
    {

    	$user->delete();
    	return Redirect::to('admin/viewuser/'.\Auth::user()->user_id)
 			->withFlashMessage('Delete User Sucessfully');
    }
    public function editreporter($user)
    {
    	return view('adminpages/editreporter')->withUser($user);
    }
    
     public function storereporter(CreateUserRequest  $request)
    {


       $user = User::findOrFail($request->get('user_id'));

        $user->firstname = $request->get('firstname');
    	
		if($request->file('image'))
		{
			$file = $request->file('image');
        	$imageName = $this->saveImage($file);
	        $user->image = $imageName;
		}
		 $user->update($request->all());
		
		return Redirect::to('admin/viewuser/'.\Auth::user()->user_id)
 			->withFlashMessage('sucessfully Edit Reporter ');
    }
    public function saveImage($file){	
	
		$destinationPath =  public_path().'\images';

		$fileimgname = 'fileimg' . str_random(12);

		$extension = $file->getClientOriginalExtension();

		$destinationFilename = $fileimgname.'.'.$extension;

		$image_success = $file->move($destinationPath, $destinationFilename);

		return $destinationFilename;
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Session;
use App\Http\Requests\CreateUserRequest;
use App\User;
use App\News;
use App\category;
use App\Http\Requests\NewsRequest;


class AdminController extends Controller
{
    public function viewuser($user)
    {
          return view('adminpages/userlist')->withUser($user->load('categories')->orderBy('user_id')->paginate(10));
    }
    public function approved($user)
    {
        $email=$user->email;
    	$user->by_admin = 1;
    	$user->save();
        \Mail::send('email.approved',['user'=>$user],function($m)use($user){
            $m->to($user->email);
            $m->from('infor@email.com');
        });



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
    public function ajaxedit($user)
    {
     return $user;
    }
    public function checkAjax( $data, $message, $request)
    {
      if($request->ajax)
        echo json_encode($data);
    else
        return Redirect::to('admin/viewprofile')->withFlashMessage();

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


    public function addnews()
    {
     $category = category:: select('category_id','category_name')->get();
     return  view ('adminpages/news')->with('category',$category);

    }
     public function viewnews()
    {

     $news = \Auth::user()->news()->orderBy('news.created_at','desc')->paginate(10);
     return  view ('adminpages/newslist')->withNews($news);

    }
     public function editnews()
    {
     $category = category:: select('category_id','category_name')->get();
     return  view ('adminpages/news')->with('category',$category);

    }
    public function storenews(NewsRequest $request)
    {

       $user = \Auth::user()->user_id;
       $file = $request->file('image');
       $imageNmae = $this->savenewsImage($file);
       $news = new News ;
       $news = $news->fill($request->all());
       $news->body = $this->checkword($request->get('body'));
       $news->image = $imageNmae;
       $news->create_by = $user;
       $news->by_admin = 1;
       $news->status = 1;
       $news-> save();


     return  Redirect::to('admin/addnews')->withFlashMessage('news added sucessfully');
    }

    public function checkword($content)
    {

     $word =['fuck','pussy','mother fucker','lado','wankers'];
     foreach($word as $k=>$v)
        $word[$k] = preg_quote($v, '/');

    $word=implode('|',$word);

     $string =preg_replace_callback('/\b('. $word .')\b/i',function($m)
    {
            $len=strlen($m[1])-1;
            return $m[1][0].str_repeat('*',$len);
     }, $content);

        return $string;
    }
        public function savenewsImage($file){

        $destinationPath =  public_path().'\news';

        $fileimgname = 'fileimg' . str_random(12);

        $extension = $file->getClientOriginalExtension();

        $destinationFilename = $fileimgname.'.'.$extension;

        $image_success = $file->move($destinationPath, $destinationFilename);

        return $destinationFilename;
    }
public function viewprofile($user)
    {
        return view('userpages/profile')->withUser($user);
    }
    public function editprofile($user)
    {
        return view('adminpages/editprofile')->withUser($user);
    }
    public function storeprofile(CreateUserRequest  $request, $user)
    {

       $userid = \Auth::user()->user_id;
        $user->fill($request->all());
        if($request->file('image')){
            $file = $request->file('image');
            $imageName = $this->saveImage($file);

            $user->image = $imageName;

        }

        $user->save();

       return Redirect::to('admin/viewprofile/'.$userid)->withFlashMessage('edit sucessfully');
    }

}

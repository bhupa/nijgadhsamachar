<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\EditNewsRequest;
use App\category;
use App\News;
use App\User;
use Redirect;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function addnews ()
    {
       
         $category = category::select("category_id","category_name")->get();
		return view('newpages/addnews')->with('category',$category);
		
    }
    public function usernewslist ()
    {  
         $news = \Auth::user()->news->load('category');
		return view('newpages/newslist')->with('news',$news);
		
    }
    public function editnews ($news)
    {  
    $category = category::select("category_id","category_name")->get();
	 return view('newpages/editnews')->with('news',$news)->with('category',$category);	
    }
    public function deletenews($news)
    {  
    $user->delete();
	  return Redirect::to('User/usernewslist')
 			->withFlashMessage('sucessfully delete');	
    }

     public function checkAjax( $data, $message , $request)
 	{
    if($request->ajax())
    echo json_encode($data);
    else 
	return Redirect::to('User/addnews')->withFlashMessage($message);
	}
    public function usernews(NewsRequest $request)
    {
    	$user =\Auth::user()->user_id;
    	$input = $request->all();
        $file = $request->file('image');
        $imageName = $this->saveImage($file);
		$news = new News;
		$news = $news->fill($request->all());
		$news->body = $this->checkword($request->get('body'));
		$news->image = $imageName;
        $news->create_by = $user;
        $news->by_admin = 0;
        $news->status = 0;
		$news->save();
		return $this->checkAjax( $news,'Successfully Added',$request);

     }
     public function usersavenews(EditNewsRequest $request, $news)
     {
        $user =\Auth::user()->user_id;
        $input = $request->all();
		$news = $news->fill($request->all());
		$news->body = $this->checkword($request->get('body'));
        if($request->file('image')){
			$file = $request->file('image');
        	$imageName = $this->saveImage($file);
			$news->image = $imageName;
		}
        $news->edit_by = $user;
        $news->save();
        return Redirect::to('User/usernewslist')
 			->withFlashMessage('sucessfully edit');
     }

     public function saveImage($file){	
	

		$destinationPath =  public_path().'\news';

		$fileimgname = 'fileimg' . str_random(12);

		$extension = $file->getClientOriginalExtension();

		$destinationFilename = $fileimgname.'.'.$extension;

		$image_success = $file->move($destinationPath, $destinationFilename);

		return $destinationFilename;
	}
	
	public function checkword($content)
	{
		$words = ['fuck', 'pussy', 'mother fucker','lado','wanker'];
		
		foreach($words as $k=>$v)
			$words[ $k ]  = preg_quote($v,'/');

		# and to be collapsed into a **big regexpy goodness**
		$words=implode('|',$words);

		# after that, a single preg_replace_callback() would do

		$string = preg_replace_callback('/\b('. $words .')\b/i', function($m)
		{
			 $len=strlen($m[1])-1;
		 	 return $m[1][0].str_repeat('*',$len);
		}, $content);

		return $string;
	}
}
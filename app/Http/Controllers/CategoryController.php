<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Auth;
use App\category;
use App\Http\Requests\CategoryRequest;
use Input;
use  Redirect;
use Session;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

   public function addcategory()
   {
        $category = category::all();
		return view('category/home')->with('category',$category);
		echo Response::json($channels);


     return view('category/home');

   }
   public function checkAjax( $data, $message )
 	{
 		return (Request::ajax() ) ? $data : 
 			Redirect::to('admin/addcategory')
 			->withFlashMessage($message);
	}

	public function create_category(CategoryRequest $request)
	{
		$model = category::create( $request->all() );
		return $this->checkAjax($model,'Successfully Added');
	}

}

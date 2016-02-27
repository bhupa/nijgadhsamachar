<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Auth;
use App\category;
use App\Http\Requests\CategoryRequest;
use Input;
use  Redirect;
use Session;
use Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;



class CategoryController extends Controller
{

   public function addcategory()
   {
        $category = category::all();
		return view('category/home')->with('category',$category);
	

   }
   public function checkAjax( $data, $message)
 	{
 echo json_encode($data); 

	Redirect::to('admin/addcategory')->withFlashMessage($message);
	}

	public function create_category(CategoryRequest $request)
	{
		$model = category::create( $request->all() );
		return $this->checkAjax($model,'Successfully Added');
	}

}

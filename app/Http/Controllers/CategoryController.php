<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Auth;
use Response;
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
        $category = category::select("category_id","category_name")->get();
		return view('category/home')->with('category',$category);
		

   }
   public function checkAjax( $data, $message , $request)
 	{
    if($request->ajax())
    echo json_encode($data);
    else 
	return Redirect::to('admin/addcategory')->withFlashMessage($message);
	}

	public function create_category(CategoryRequest $request)
	{

		$user=\Auth::user()->user_id;
		$model = category::create( $request->all() );
		$model->create_by = $user;
		$model->save();
		return $this->checkAjax( $model,'Successfully Added',$request);
	}
	public function editcategory($category)
	{
	 return view('category/editcategory')->with('category', $category);
	}
	public function update_category (CategoryRequest $request, $category)
	{
		$user=\Auth::user()->user_id;
	 	$category->fill($request->all());
	 	$category->edited_by=$user;
	 	$category->save();	
	 	return $this->checkAjax($category,'Successfully edit',$request);	
	}
	public function deletcategory(Request $request,$category)
	{
		$category->delete();
		return $this->checkAjax($category,'Successfully delete',$request);	
	}

}

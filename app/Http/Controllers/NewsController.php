<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\category;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function addnews ()
    {
    	
        $category = category::all();
		return view('newpages/addnews')->with('category',$category);
		
    }
}

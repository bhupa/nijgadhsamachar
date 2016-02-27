<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('index/', function () {
    return view('welcome');
    });



/*
/*



|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {


	Route::get('user/index', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('User/index','UserController@index');
	Route::get('User/adduser','UserController@adduser');
	Route::post('User/storeuser','UserController@storeuser');

	Route::group( ['middleware'=> 'auth'] , function(){	
		         Route::get('User/viewprofile/{User}','UserController@viewprofile');
		         Route::get('User/editprofile/{User}','UserController@editprofile');
		         Route::post('User/storeprofile/{User}','UserController@storeprofile');
		         Route::post('News/addnews/','UserController@addnews');
   				 Route::get('auth/logout', 'Auth\AuthController@getLogout');
				Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin'], function(){
					Route::get('viewuser/{User}','AdminController@viewuser');
					Route::get('approved/{User}','AdminController@approved');
					Route::get('editreporter/{User}','AdminController@editreporter');
					Route::post('storereporter/{User}','AdminController@storereporter');
					Route::get('deleteuser/{User}','AdminController@deleteuser');
					Route::get('addcategory/{User}','CategoryController@addcategory');
					Route::post('create_category/{User}','CategoryController@create_category');

					
		        });
	     });

});

Route::bind('User',function($id){
if($user = App\user::find($id)){
return $user;
}
throw new App\Exceptions\DataNotFoundException;
});

Route::bind('Category',function($id){
if($user = App\category::find($id)){
return $user;
}
throw new App\Exceptions\DataNotFoundException;
});
//administration= database
// system password
// user_name sys @orcl as sysdba
// database name orcl
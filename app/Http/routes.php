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


	Route::get('/', function () {
		$news = App\News::whereStatus(1)->latest()->with('category','comments.user')->take(8)->get();

		$categoryNews = App\category::has('news')->with(['news.comments.user' =>function($q){
			$q->orderBy('created_at','desc')->where('status',1);
		}])->get();

		return view('newpages/homepage')->with('latestNews',$news)->with('categoryNews',$categoryNews);
	});
// Route::group(['middleware' => ['web']], function () {
// //
//
// 	Route::get('/', function () {
//
//
// 		return view('main/');
// 	});

	Route::get('news/{News}',function($news){
		$news = $news->load('comments.user');
		return view('newpages/newssingle')->with('news',$news);
	});

	Route::get('{Category}/news',function($category){
		$allNews = $category->load( ['news'=>function($q){
			$q->latest();
		}])->news;
		return view('categorynews.categorywithnews')->with('allNews',$allNews);
	});

  Route::get('User/login', 'UserController@login');
	Route::get('user/index', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('User/index','UserController@index');
	Route::get('User/adduser','UserController@adduser');
	Route::post('User/storeuser','UserController@storeuser');

	Route::group( ['middleware'=> 'auth'] , function(){

	Route::post('add/comment/{News}','CommentController@addcomment');
	Route::get('delete/comment/{Comment}','CommentController@deletecomment');
	Route::post('edit/comment/{Comment}','CommentController@editcomment');
	


		         Route::get('User/viewprofile/{User}','UserController@viewprofile');
		         Route::get('User/editprofile/{User}','UserController@editprofile');
		         Route::post('User/storeprofile/{User}','UserController@storeprofile');
		         Route::get('User/addnews/','NewsController@addnews');
		         Route::post('User/usernews/','NewsController@usernews');
		         Route::get('User/usernewslist/','NewsController@usernewslist');
		         Route::get('User/approvenews/{News}','NewsController@approveNews');
		         Route::get('User/catnewslist/','NewsController@catnewslist');
		         Route::get('User/editnews/{News}','NewsController@editnews');
		         Route::post('User/usersavenews/{News}','NewsController@usersavenews');
		         Route::get('User/deletenews/{News}','NewsController@deletenews');
						 Route::get('assign/category/{Category}/user/{User}',function($category,$user){

						if($user->isAssignedCat($category))
							return App::abort(400);
							 $user->categories()->attach($category);
							 return $user->categories;
						 });
					 Route::get('auth/logout', 'Auth\AuthController@getLogout');



				Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin'], function(){
					Route::get('viewprofile/{User}','AdminController@viewprofile');
					Route::get('editprofile/{User}','AdminController@editprofile');
					Route::post('storeprofile/{User}','AdminController@storeprofile');
					Route::get('ajaxedit/{User}','AdminController@ajaxedit');


					Route::get('viewuser/{User}','AdminController@viewuser');
					Route::get('approved/{User}','AdminController@approved');
					Route::get('editreporter/{User}','AdminController@editreporter');
					Route::post('storereporter/{User}','AdminController@storereporter');
					Route::get('deleteuser/{User}','AdminController@deleteuser');
					Route::get('addcategory/','CategoryController@addcategory');
					Route::post('create_category/','CategoryController@create_category');
					Route::get('editcategory/{Category}','CategoryController@editcategory');
					Route::post('update_category/{Category}','CategoryController@update_category');
					Route::get('deletcategory/{Category}','CategoryController@deletcategory');
					Route::get('addnews','AdminController@addnews');
					Route::post('storenews','AdminController@storenews');
					Route::get('viewnews','AdminController@viewnews');
					Route::get('editnews', 'AdminController@editnews');

							        });
	     });
Route::get('all/news',function(){
						if( Auth::user() ){
							$news = Auth::user()->news()->paginate(10);
							return view('try.news-list')->with('news',$news);
						}
						else{
							echo 'Lp';
						}
					});

});




Route::bind('User',function($id){
if($user = App\user::find($id)){
return $user;
}
throw new App\Exceptions\DataNotFoundException;
});

Route::bind('Category',function($id){
if($category = App\category::find($id)){
return $category;
}
throw new App\Exceptions\DataNotFoundException;
});
Route::bind('News',function($id){
if($news = App\News::find($id)){
return $news;
}
throw new App\Exceptions\DataNotFoundException;
});
Route::bind('Comment',function($id){
if($comment = App\Comment::find($id)){
return $comment;
}
throw new App\Exceptions\DataNotFoundException;
});

//administration= database
// system password
// user_name sys @orcl as sysdba
// database name orcl

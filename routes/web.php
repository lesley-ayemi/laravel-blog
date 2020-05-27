<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
//login route
Route::auth();

//logout route
Route::get('/logout', 'Auth\LoginController@logout');




//admin route
Route::group(['middleware' => 'admin'], function () {

//admin index
Route::get('/admin', 'AdminController@index');

//admin users route
Route::resource('admin/users', 'AdminUsersController', ['names'=>[

    'index'=>'admin.users.index',
    'create'=>'admin.users.create',
    'store'=>'admin.users.store',
    'edit'=>'admin.users.edit'


]]);

//posts route
Route::resource('admin/posts', 'AdminPostsController', ['names'=>[

    'index'=> 'admin.posts.index',
    'create'=> 'admin.posts.create',
    'store'=>'admin.post.store',
    'edit'=> 'admin.posts.edit'
    


]]);

//indivisual post display
Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'HomeController@post']);


//categories route
Route::resource('admin/categories', 'AdminCategoriesController', ['names'=>[

    'index'=> 'admin.categories.index',
    'store'=>'admin.categories.store',
    'edit'=> 'admin.categories.edit'
    


]]);

//all media route
Route::resource('admin/media', 'AdminMediasController' , ['names'=>[

    'index'=> 'admin.media.index',
    'create'=> 'admin.media.create',
    'store'=>'admin.media.store'
    


]]);

Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

//comment route 
Route::resource('admin/comments', 'PostCommentsController', ['names'=>[

    'index'=> 'admin.comments.index',
    'show'=> 'admin.comments.show',
    'store'=>'admin.comments.store',
    

]]);

//reply for comment route in admin
Route::resource('admin/comment/replies', 'CommentRepliesController', ['names'=>[

    'index'=> 'admin.comments.replies.index',
    'show'=> 'admin.comments.replies.show',
    'store'=>'admin.comments.replies.store',
    


]]);


});


//route for comment replies
Route::group(['middleware' => 'auth'], function () {

    Route::post('comment/reply', 'CommentRepliesController@createReply');

});


// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

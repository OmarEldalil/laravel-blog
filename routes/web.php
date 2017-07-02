<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('blog/{slug}', ['as'=> 'blog.single', 'uses'=>'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['as'=> 'blog.index', 'uses'=> 'BlogController@getIndex']);
Route::get('/contact', 'PagesController@getContact');
Route::post('/contact', ['uses'=>'PagesController@postContact', 'as'=>'postcontact']);
Route::get('/about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');
Route::resource('/posts', 'PostController');
Route::resource('/categories', 'CategoriesController', ['except'=>['create', 'edit', 'update']]);
Route::resource ('/tags', 'TagsController', ['except'=>['create', 'edit', 'update']]);

//comments
Route::get('comment/{post_id}/edit', ['as'=>'comments.edit', 'uses'=> 'CommentController@edit']);
Route::post('comment/{post_id}' , ['as'=>'comments.store', 'uses'=>'CommentController@store']);
Route::put('comment/{post_id}', ['as'=>'comments.update', 'uses'=> 'CommentController@update']);
Route::delete('comment/{post_id}', ['as'=>'comments.destroy', 'uses'=> 'CommentController@destroy']);



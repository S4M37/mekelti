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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/feed','FeedController@index');

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
    //
});

Route::get('/feed/{link}','FeedController@index')->where('link', '[0-9]+');
Route::get('/link','FeedController@links');
Route::post('/link','FeedController@links');
Route::group(['prefixe'=>'/recette'],function(){
	route::match(['get','post'],'/','RecetteController@getRecette');
	route::match(['get','post'],'/form','RecetteController@index');
	route::post('/add','RecetteController@store');
	route::get('/update/{id}','RecetteController@getUpdate')->where('id', '[0-9]+');
	route::get('/delete/{id}','RecetteController@delete')->where('id', '[0-9]+');
	route::get('/addparsedrecipe','RecetteController@storeParserRecipe');
});

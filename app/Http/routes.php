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
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['prefix' => 'recette'], function () {
    Route::get('/feed', 'FeedController@index');
    Route::get('/feed/{link}', 'FeedController@index')->where('link', '[0-9]+');
    Route::get('/link', 'FeedController@links');
    route::match(['get', 'post'], '/', 'RecetteController@getRecette');
    route::match(['get', 'post'], '/form', 'RecetteController@index');
    route::post('/add', 'RecetteController@store');
    route::get('feed/addparsedrecipe', 'RecetteController@storeParserRecipe');
    Route::group(['prefix' => '/{id_Recette}'], function () {
        route::get('/', 'RecetteController@getRecette');
        route::get('/form', 'RecetteController@getUpdate');
        route::post('/update', 'RecetteController@Update');
        route::get('/delete', 'RecetteController@delete');
    });
});

//mobile
Route::group(['prefix' => 'mobile'], function () {
    route::post('/signin', 'MobileController@signin');
    route::post('/logout', 'MobileController@logout');
    route::post('/signup', 'MobileController@signup');
    route::get('/validate/{id_user}/{validation_code}', 'MobileController@validateEmail');
});

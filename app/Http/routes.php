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


//recette Admin
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

//proposition
Route::group(['prefix' => 'proposition'], function () {
    route::get('/', 'ProposedRecetteAdminController@getAllProposed');
    Route::group(['prefix' => '/{id_Proposed}'], function () {
        route::get('/validate', 'ProposedRecetteAdminController@validateProposition');
        route::get('/refuser', 'ProposedRecetteAdminController@refuser');
    });
});

//mobile
Route::group(['prefix' => 'mobile'], function () {
    route::post('/signin', 'MobileController@signin');
    route::post('/logout', 'MobileController@logout');
    route::post('/signup', 'MobileController@signup');
    route::get('/validate/{id_user}/{validation_code}', 'MobileController@validateEmail');
});

//search
Route::group(['prefix' => 'search'], function () {
    route::get('/', 'searchController@searchAutoCompelte');
});

//user
Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => '/{id_User}'], function () {
        route::get('/', 'UserController@getUser');
        route::get('/newsfeed', 'UserController@getNewsFeed');
        route::post('/update', 'UserController@updateUser');
        route::get('/delete', 'UserController@deleteUser');
        Route::group(['prefix' => '/favoris'], function () {
            route::get('/', 'UserController@getFavoris');
            route::post('/add', 'UserController@storeFavoris');
            Route::group(['prefix' => '/{id_Favoris}', 'before' => 'id_User'], function () {
                route::get('/delete', 'UserController@deleteFavoris');
            });
        });
        Route::group(['prefix' => '/proposed'], function () {
            route::get('/', 'ProposedRecetteController@getProposed');
            route::post('/store', 'ProposedRecetteController@proposeRecette');
            Route::group(['prefix' => '/{id_Propose}'], function () {
                route::get('/', 'ProposedRecetteController@getProposed');
                route::post('/update', 'ProposedRecetteController@proposeRecette');
                route::get('/delete', 'ProposedRecetteController@delete');
            });
        });
    });
});




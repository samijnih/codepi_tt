<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

///////////
// Index //
///////////
Route::get('/', [
    'as'   => 'index',
    'uses' => 'IndexController@index',
]);

//////////////////
// Admin routes //
//////////////////
Route::group([
    'prefix'    => 'admin',
    'namespace' => 'Admin',
    'as'        => 'admin::',
], function () {
    /////////////////
    // Auth routes //
    /////////////////
    Route::group([
        'as'        => 'auth::',
        'namespace' => 'Auth',
    ], function () {
        Route::get('login', [
            'as'   => 'login',
            'uses' => 'AuthController@getLogin',
        ]);

        Route::post('login', [
            'as'   => 'login',
            'uses' => 'AuthController@postLogin',
        ]);

        Route::get('logout', [
            'as'   => 'logout',
            'uses' => 'AuthController@getLogout',
        ]);
    });
    
    /////////////////
    // Shows route //
    /////////////////
    Route::group([
        'middleware' => 'auth',
        'as'         => 'show::',
        'namespace'  => 'Show',
    ], function () {
        Route::get('/', [
            'as'   => 'index',
            'uses' => 'ShowController@index',
        ]);

        Route::get('create', [
            'as'   => 'create',
            'uses' => 'ShowController@create',
        ]);

        Route::get('{id}', [
            'as'   => 'show',
            'uses' => 'ShowController@show',
        ]);

        Route::post('/', [
            'as'   => 'store',
            'uses' => 'ShowController@store',
        ]);

        Route::patch('{id}', [
            'as'   => 'update',
            'uses' => 'ShowController@update',
        ]);

        Route::delete('{id}', [
            'as'   => 'destroy',
            'uses' => 'ShowController@destroy',
        ]);
    });
});
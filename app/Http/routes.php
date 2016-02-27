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

/////////////////
// Auth routes //
/////////////////
Route::group([
    'prefix'    => 'admin',
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


<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::group(['before' => 'guest'], function (){
Route::group(['before' => 'csrf'], function () {
    Route::post('login', 'MyController@postLogin');
    Route::post('register', 'MyController@postRegister');
});

Route::get('/', 'MyController@index');
Route::get('login', 'MyController@index');
Route::get('register', 'MyController@showRegister');
//});

Route::group(['before' => 'auth'], function () {
    Route::group(['before' => 'csrf'], function () {
        Route::group(['prefix' => 'events'], function () {
            Route::get('/', ['as' => 'main', 'uses' => 'EventsController@index']);
            Route::get('/{get}', ['as' => 'add', 'uses' => 'EventsController@create']);
            Route::post('update/{get}', 'EventsController@update');
            Route::get('delete/{get}', 'EventsController@destroy');
            Route::post('/store', 'EventsController@store');
        });
        Route::get('signout', 'MyController@logout');
    });
});

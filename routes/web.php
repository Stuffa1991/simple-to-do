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

Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => 'tasks'], function() {
        Route::get('all', 'TaskController@index');
        Route::get('get', 'TaskController@view');
        Route::post('create', 'TaskController@create');
        Route::post('edit', 'TaskController@edit');
        Route::post('delete', 'TaskController@delete');
    });
});

Route::get('', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');

Auth::routes();

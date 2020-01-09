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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	// For Post's router
    Route::get('post/index', ['as' => 'post.index', 'uses' => 'PostController@index']);
    Route::get('post/create', ['as' => 'post.create', 'uses' => 'PostController@create']);
    Route::post('post/create', ['as' => 'post.store', 'uses' => 'PostController@store']);
    Route::put('post/{post}/update', ['as' => 'post.update', 'uses' => 'PostController@update']);
    Route::get('post/{post}/edit', ['as' => 'post.edit', 'uses' => 'PostController@edit']);
    Route::delete('post/{post}/delete', ['as' => 'post.destroy', 'uses' => 'PostController@destroy']);
});


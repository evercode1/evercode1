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



// Pages Routes

Route::get('/', 'PagesController@index')->name('pages.index');


// Post Routes

Route::get('post/create',  'PostController@create')->name('post.create');

Route::get('post/{post}-{slug?}', 'PostController@show')->name('post.show');

Route::resource('post', 'PostController', ['except' => ['show', 'create']]);


// Test Routes

Route::get('test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

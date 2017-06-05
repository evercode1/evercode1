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

// Admin route

Route::get('/admin', 'AdminController@index')->name('admin');

// Api routes

Route::get('api/category-data', 'ApiController@categoryData');
Route::get('api/category-list', 'ApiController@categoryList');
Route::get('api/post-data', 'ApiController@postData');
Route::get('api/user-data', 'ApiController@userData');


// Authentication routes

Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

// Category Routes

Route::post('category-delete/{category}', 'CategoryController@destroy');

Route::resource('category', 'CategoryController');

// Pages Routes

Route::get('/', 'PagesController@index')->name('pages.index');

// Password Reset Routes...

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// Post Routes

Route::get('post-by-category/{id}', 'PostsByCategoryController@index')->name('post.by-category');

Route::post('post-delete/{post}', 'PostController@destroy');

Route::get('post/create',  'PostController@create')->name('post.create');

Route::get('post/{post}-{slug?}', 'PostController@show')->name('post.show');

Route::resource('post', 'PostController', ['except' => ['show', 'create']]);


// Registration routes

Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\AuthController@register');

// Settings routes

Route::get('settings', 'SettingsController@edit');

Route::post('settings', 'SettingsController@update')->name('user-update');

// Socialite routes

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


// Test Routes

Route::get('test', 'TestController@index');

Route::get('/home', 'HomeController@index')->name('home');

// User routes

Route::resource('user', 'UserController');

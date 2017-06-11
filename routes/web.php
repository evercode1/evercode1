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

Route::get('api/about-data', 'ApiController@aboutData');
Route::get('api/alarm-data', 'ApiController@alarmData');
Route::get('api/alarm-support-data', 'ApiController@alarmSupportData');
Route::get('api/archives', 'ApiController@archives');
Route::get('api/blog-resource-data', 'ApiController@blogResourceData');
Route::get('api/book-data', 'ApiController@bookData');
Route::get('api/category-data', 'ApiController@categoryData');
Route::get('api/category-list', 'ApiController@categoryList');
Route::get('api/closed-contact-data', 'ApiController@closedContactData');
Route::get('api/contact-data', 'ApiController@ContactData');
Route::get('api/contact-topic-data', 'ApiController@ContactTopicData');
Route::get('api/content-data', 'ApiController@ContentData');
Route::get('api/content-list', 'ApiController@ContentList');
Route::get('api/featured-book', 'ApiController@featuredBook');
Route::get('api/open-contact-data', 'ApiController@openContactData');
Route::get('api/post-data', 'ApiController@postData');
Route::get('api/signature-data', 'ApiController@signatureData');
Route::get('api/total-books', 'ApiController@totalBooks');
Route::get('api/total-posts', 'ApiController@totalPosts');
Route::get('api/total-resources', 'ApiController@totalResources');
Route::get('api/total-users', 'ApiController@totalUsers');
Route::get('api/user-data', 'ApiController@userData');


// Authentication routes

Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

// Blog Resource Routes

Route::resource('/blogresource', 'BlogResourceController');

// Book Routes

Route::resource('book', 'BookController');

// Category Routes

Route::post('category-delete/{category}', 'CategoryController@destroy');

Route::resource('category', 'CategoryController');

// Contact Routes

Route::post('/contact-delete', 'ContactController@destroy')->name('contact.destroy');

Route::resource('/contact', 'ContactController', ['except' => ['destroy']]);

Route::get('/open-contacts', 'OpenContactController@index')->name('contact.open');

Route::get('/closed-contacts', 'ClosedContactController@index');

Route::post('/contact-topic-delete', 'ContactController@destroy')->name('contact-topic.destroy');

Route::resource('/contact-topic', 'ContactTopicController', ['except' => ['destroy']]);

// Content Routes

Route::post('content-delete/{content}', 'ContentController@destroy');

Route::resource('/content', 'ContentController', ['except' => ['destroy']]);

// Messages route

Route::get('support-messages', 'MessagesController@index');

Route::get('support-messages-show/{message}', 'MessagesController@show');

// Pages Routes

Route::get('/', 'PagesController@index')->name('pages.index');

Route::get('/about', 'PagesController@about')->name('pages.about');

Route::get('/privacy-policy', 'PagesController@privacy')->name('pages.privacy');

Route::get('/terms-of-service', 'PagesController@terms')->name('pages.terms');

// Password Reset Routes...

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// Post Routes

Route::get('post-by-category/{id}', 'PostsByCategoryController@index')->name('post.by-category');

Route::get('post-by-date/{date}', 'PostsByDateController@index')->name('post.by-date');

Route::post('post-delete/{post}', 'PostController@destroy')->name('post.destroy');

Route::get('post/create',  'PostController@create')->name('post.create');

Route::get('post/{post}-{slug?}', 'PostController@show')->name('post.show');

Route::resource('post', 'PostController', ['except' => ['show', 'create', 'destroy']]);


// Registration routes

Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\AuthController@register');

// Reply Routes

Route::resource('reply', 'ReplyController');

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

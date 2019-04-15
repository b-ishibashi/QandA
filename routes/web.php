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
Route::middleware('guest')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::get('/add', 'RegisterController@create');
    Route::post('/add', 'RegisterController@store');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/profile', 'HomeController@showprofile');
    Route::get('/home/profile/logout', 'HomeController@logout');
    Route::get('/home/create', 'PostController@create');
    Route::post('/home/create', 'PostController@confirm');
    Route::post('/home/confirm', 'PostController@store')->middleware('throttle:1,1');
});



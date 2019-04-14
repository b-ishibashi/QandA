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

Route::middleware('auth')->group(function () {
    Route::post('/login', 'IndexController@login');
    Route::get('/home', 'HomeController@index');
    Route::get('/home/profile', 'HomeController@showprofile');
    Route::get('/home/profile/logout', 'HomeController@logout');
});

Route::get('/', 'IndexController@index');
Route::get('/add', 'IndexController@add');
Route::post('/add', 'IndexController@create');
Route::get('/login', 'IndexController@showLoginForm')->name('login');




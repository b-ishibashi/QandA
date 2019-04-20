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
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home/profile', 'UserController@showprofile');
    Route::get('/home/profile/logout', 'UserController@logout');
    Route::get('/home/profile/edit/{id}', 'UserController@edit');
    Route::post('/home/profile/edit/{id}', 'UserController@update');
    Route::get('/home/create', 'QuestionController@create');
    Route::post('/home/create', 'QuestionController@confirm');
    Route::get('/home/confirm', function () {
        return redirect('/home');
    });
    Route::post('/home/confirm', 'QuestionController@store')->middleware('throttle:1,1');
    Route::get('/home/question/{id}', 'QuestionController@show');
    Route::post('/home/question/{id}/answer', 'AnswerController@store');
});



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

// ログインしてるときとしてないときで動作を変える
// ログインしてなかったらサイト紹介ページ、ログインしてたらホーム
Route::get('/', 'IndexController@index');

Route::middleware('guest')->group(function () {

    // 登録フォームと登録処理
    Route::get('/register', 'RegisterController@create');
    Route::post('/register', 'RegisterController@store');

    // ログインフォームとログイン処理
    Route::get('/login', 'SessionController@showLoginForm');
    Route::post('/login', 'SessionController@login');
});

Route::middleware('auth')->group(function () {

    // ログアウト処理
    Route::post('/logout', 'SessionController@logout');

    // ユーザ情報（プロフィール含む）
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::get('/users/{user}', 'UserController@show');
    Route::put('/users/{user}', 'UserController@update');

    // 回答
    Route::post('/questions/{question}/answer', 'AnswerController@store');

    // ベストアンサー作成
    Route::post('/questions/{question}/{answer}', 'AnswerController@selectForBest');

    // 質問
    Route::get('/questions/search', 'QuestionController@search');
    Route::get('/questions/create', 'QuestionController@create');
    Route::post('/questions/create', 'QuestionController@confirm');
    Route::get('/questions/{question}', 'QuestionController@show');
    Route::post('/questions', 'QuestionController@store');
});

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
//トップページ
Route::get('/', function(){
    return '<a href="/bbs">BBS</a>';
});

//スレッド一覧表示
Route::get('/bbs', 'BbsController@index');

//スレッド作成ページ表示
Route::get('/bbs/create', 'BbsController@create');

//スレッド作成処理
Route::post('/bbs/create', 'BbsController@create_thread');

//スレッド詳細表示
Route::get('/bbs/show', 'BbsController@show');

//掲示板への書き込み
Route::post('/bbs/store', 'BbsController@store');
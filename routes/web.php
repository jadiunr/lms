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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    //トップページ
    Route::get('/', 'HomeController@index');

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

    //パスワード変更ページ
    Route::get('/edit', 'EditController@getIndex');

    //パスワード変更
    Route::post('/password','EditController@password');

    //アイコン編集ページ
    Route::get('/edit','EditController@edit');

    //アイコンアップロード
    Route::post('/upload', 'EditController@upload');

    //試験メニュー画面のtop画面
    Route::get('/{exam_id}/exam',ExamController::class."@index")->name('top');

    //ラーニングモードの画面
    Route::get('/{exam_id}/exam/learning',ExamController::class."@learn");

    //ラーニングモード各問題画面
    Route::get('/{exam_id}/exam/learning/{id}',ExamController::class."@learn_id")->name('problem_id');

    //正誤判定
    Route::get('/{exam_id}/exam/learning/answer/{problem_id}/{problem_answer}',ExamController::class."@answer");

    Route::group(['middleware' => 'admin'], function(){
        //管理者::ユーザ管理ページ表示
        Route::get('/admin/users', [
            'uses' => 'AdminController@getUsers',
            'as' => 'admin.users'
        ]);

        //管理者::ユーザ編集ページ表示
        Route::get('/admin/users/edit/{id}', [
            'uses' => 'AdminController@editUser',
            'as' => 'admin.editUser'
        ]);

        //管理者::ユーザ更新処理
        Route::post('/admin/users/update/{id}', [
            'uses' => 'AdminController@updateUser',
            'as' => 'admin.updateUser'
        ]);
    });
});
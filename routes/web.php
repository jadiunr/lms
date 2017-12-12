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

use \App\Http\Middleware\Session_set;
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

    //質問を解決済みにする処理
    Route::post('/bbs/solved', 'BbsController@solved');

    //質問を未解決に戻す処理
    Route::post('bbs/reopen', 'BbsController@reopen');

    //掲示板の検索機能
    Route::get('/bbs/search', 'BbsController@search');

    //パスワード変更
    Route::post('/password','EditController@password');

    //名前変更
    Route::post('/name','EditController@name');

    //情報変更ページ(アイコン, パスワード)
    Route::get('/edit', [
        'uses' => 'EditController@edit',
        'as' => 'user.edit'
    ]);
    
    //アイコンアップロード
    Route::post('/upload', 'EditController@upload');

    //試験選択
    Route::get('/exam', 'ExamController@getExams');

    //試験年度選択
    Route::get('/exam/{exam_id}','ExamController@block');

    //ラーニングモード or テストモード スタート
    Route::post('/exam/{exam_id}/{block_id}/{mode_id}/start', 'ExamController@start');

    Route::group(['middleware' => 'session_set'], function(){

        //モード選択
        Route::get('/exam/{exam_id}/{block_id}','ExamController@index');

        //ラーニングモード各問題画面
        Route::get('/exam/{exam_id}/{block_id}/{mode_id}/{id}','ExamController@learn_id')->name('problem_id');

        //正誤判定
        Route::get('/exam/{exam_id}/{block_id}/{mode_id}/{id}/{problem_answer}','ExamController@answer');

        //解答リスト
        Route::post('/exam/{exam_id}/{block_id}/{mode_id}','ExamController@answer_list');

    });

    //changelog
    Route::get('/changelog', 'ChangelogController@show');

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

        Route::get('/admin/exams', [
           'uses' => 'AdminController@getExams',
            'as' => 'admin.exams'
        ]);

        //スレッド管理
        Route::get('/admin/bbs', 'BbsAdminController@index');

        //コメント管理
        Route::get('/admin/bbs/show', 'BbsAdminController@show');

        //スレッド削除
        Route::post('/admin/bbs/delete_thread', 'BbsAdminController@delete_thread');

        //コメント削除
        Route::post('/admin/bbs/delete_post', 'BbsAdminController@delete_post');
    });
});
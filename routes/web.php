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
    Route::get('/edit', 'EditController@edit')->name('user.edit');
    
    //アイコンアップロード
    Route::post('/upload', 'EditController@upload');

    //試験選択
    Route::get('/exam', 'ExamController@getExams');

    //試験年度選択
    Route::get('/exam/{exam_id}','ExamController@block');


    Route::get('/exam/{exam_id}/{block_id}','ExamController@index');

    //ラーニングモード or テストモード スタート
    Route::post('/exam/{exam_id}/{block_id}/{mode_id}/start', 'ExamController@start');

    //モード選択

    Route::group(['middleware' => 'session_set'], function(){


        //ラーニングモード各問題画面
        Route::get('/exam/{exam_id}/{block_id}/{mode_id}/{id}','ExamController@learn_id')->name('problem_id');

        //正誤判定
        Route::get('/exam/{exam_id}/{block_id}/{mode_id}/{id}/{problem_answer}','ExamController@answer');

        //解答リスト
        Route::post('/exam/{exam_id}/{block_id}/{mode_id}','ExamController@answer_list');

        Route::get('/record/{exam_id}','RecordController@view');

        Route::get('/record/{exam_id}/history/{time}','RecordController@history');

        Route::get('/record/{exam_id}/history/{time}/{id}','RecordController@details');


    });

    //changelog
    Route::get('/changelog', 'ChangelogController@show');

    //ranking
    Route::get('/ranking','RankingController@total');

    //試験別正答率
    Route::get('/ranking/percentage','RankingController@percentage');

    //管理者用Route
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

        //LaravelFileManager
        Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show')->name('admin.getLfm');

        //LaravelFileManager
        Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload')->name('admin.postLfm');

        // ユーザ管理ページ
        Route::get('/users', 'AdminController@getUsers')->name('admin.users');

        // ユーザ編集ページ
        Route::get('/users/edit/{user_id}', 'AdminController@editUser')->name('admin.editUser');

        // ユーザ更新処理
        Route::post('/users/update/{user_id}', 'AdminController@updateUser')->name('admin.updateUser');

        //ユーザ削除処理
        Route::post('/users/delete', 'AdminController@deleteUser')->name('admin.deleteUser');

        //ユーザ検索処理
        Route::get('/users/search', 'AdminController@searchUser')->name('admin.searchUser');

        // 試験管理ページ
        Route::get('/exams', 'AdminController@getExams')->name('admin.exams');

        // 試験作成ページ
        Route::get('/exams/create-exam', 'AdminController@getCreateExam')->name('admin.getCreateExam');

        // 試験作成処理
        Route::post('/exams/create-exam', 'AdminController@postCreateExam')->name('admin.postCreateExam');

        // 試験削除
        Route::post('/exams/delete', 'AdminController@deleteExam')->name('admin.deleteExam');

        // グローバルブロック一覧
        Route::get('/exams/blocks', 'AdminController@getBlocksGlobal')->name('admin.getBlocksGlobal');

        // グローバルブロック作成ページ
        Route::get('/exams/blocks/create-block-g', 'AdminController@getCreateBlockGlobal')->name('admin.getCreateBlockGlobal');

        // グローバルブロック作成処理
        Route::post('/exams/blocks/create-block-g', 'AdminController@postCreateBlockGlobal')->name('admin.postCreateBlockGlobal');

        // グローバルブロック削除
        Route::post('/exams/blocks/delete', 'AdminController@deleteBlockGlobal')->name('admin.deleteBlockGlobal');

        // グローバルブロック編集ページ
        Route::get('/exams/blocks/{block_id}', 'AdminController@editBlockGlobal')->name('admin.editBlockGlobal');

        // グローバルブロック更新処理
        Route::post('/exams/blocks/{block_id}', 'AdminController@updateBlockGlobal')->name('admin.updateBlockGlobal');

        // 試験詳細ページ
        Route::get('/exams/{exam_id}', 'AdminController@editExam')->name('admin.editExam');

        // 試験更新処理
        Route::post('/exams/{exam_id}', 'AdminController@updateExam')->name('admin.updateExam');

        //試験ブロック作成
        Route::get('/exams/{exam_id}/create-block', 'AdminController@createBlock')->name('admin.createBlock');

        //試験ブロック編集ページ
        Route::get('/exams/{exam_id}/{block_id}', 'AdminController@editBlock')->name('admin.editBlock');

        //試験ブロック名更新処理
        Route::post('/exams/{exam_id}/{block_id}', 'AdminController@updateBlock')->name('admin.updateBlock');

        //試験ブロック削除
        Route::post('/exams/{exam_id}/{block_id}/delete', 'AdminController@deleteBlock')->name('admin.deleteBlock');

        // 問題作成ページ
        Route::get('/exams/{exam_id}/{block_id}/create-problem', 'AdminController@getCreateProblem')->name('admin.getCreateProblem');

        // 問題作成処理
        Route::post('/exams/{exam_id}/{block_id}/create-problem', 'AdminController@postCreateProblem')->name('admin.postCreateProblem');

        //問題編集ページ
        Route::get('/exams/{exam_id}/{block_id}/{problem_id}', 'AdminController@editProblem')->name('admin.editProblem');

        //問題更新
        Route::post('/exams/{exam_id}/{block_id}/{problem_id}', 'AdminController@updateProblem')->name('admin.updateProblem');

        // 問題削除
        Route::post('/exams/{exam_id}/{block_id}/{problem_id}/delete', 'AdminController@deleteProblem')->name('admin.deleteProblem');

        // 成績表示
        Route::get('/records', 'AdminController@getRecords')->name('admin.getRecords');

        // 成績検索
        Route::get('/records/search', 'AdminController@searchRecord')->name('admin.searchRecord');

        // 成績削除
        Route::post('/records/delete', 'AdminController@deleteRecord')->name('admin.deleteRecord');

        //スレッド管理
        Route::get('/bbs', 'BbsAdminController@index');

        //コメント管理
        Route::get('/bbs/show', 'BbsAdminController@show');

        //スレッド削除
        Route::post('/bbs/delete_thread', 'BbsAdminController@delete_thread');

        //コメント削除
        Route::post('/bbs/delete_post', 'BbsAdminController@delete_post');

    });
});
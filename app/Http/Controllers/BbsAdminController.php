<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;
use App\Setting;

class BbsAdminController extends Controller
{
    public function index() {
        /*
         * スレッド一覧
         */
        //1ページに表示するスレッド数
        $per_page = 10;
        $threads = Thread::latest('updated_at')
            ->orderBy('id','desc')
            ->paginate($per_page);

        $setting = Setting::where('name', 'admin_mail')->first();

        return view('admin.bbs.index',[
            "threads" => $threads,
            "current_mail_flag" => $setting->flag
        ]);
    }

    public function show(Request $request) {
        /*
         * スレッド詳細
         */
        $posts = Post::where('thread_id', $request->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.bbs.show',[
            "posts" => $posts
        ]);
    }

    public function delete_thread(Request $request) {
        /*
         * スレッド削除
         */
        Thread::where('id', $request->thread_id)
            ->delete();

        $request->session()->flash('message','削除しました');
        return redirect()->back();
    }

    public function delete_post(Request $request) {
        /*
         * コメント削除
         */
        Post::where('id', $request->post_id)
            ->delete();

        $request->session()->flash('message','削除しました');
        return redirect()->back();
    }

    public function set_mail_flag(Request $request){
        $setting = Setting::where('name', 'admin_mail')->first();
        if($request->mail_flag == null){
            $setting->flag = 0;
        }else {
            $setting->flag = $request->mail_flag;
        }
        $setting->save();

        $request->session()->flash('message','設定を変更しました');
        return redirect()->back();
    }
}

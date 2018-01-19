<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;

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

        return view('admin.bbs.index',[
            "threads" => $threads
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
}

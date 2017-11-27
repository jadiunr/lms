<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;

class BbsAdminController extends Controller
{
    public function index() {
        $threads = Thread::latest('updated_at')
            ->orderBy('id','desc')
            ->get();

        return view('admin.bbs.index',[
            "threads" => $threads
        ]);
    }

    public function show(Request $request) {
        $posts = Post::where('thread_id', $request->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.bbs.show',[
            "posts" => $posts
        ]);
    }
}

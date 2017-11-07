<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Post;
use App\Thread;
use Illuminate\Http\Request;
use App\Http\Requests\BbsRequest;
use App\Http\Requests\ThreadRequest;
use Validator;

class BbsController extends Controller
{
    public function index() {
        /*
         * スレッド一覧を表示する
         */
        //1ページに表示するスレッド数
        $per_page = 10;
        $threads = Thread::latest('updated_at')
            ->orderBy('id','desc')
            ->paginate($per_page);

        return view('bbs.index', [
            "threads" => $threads
        ]);
    }

    public function create() {
        /*
         * 投稿ページを表示する
         */
        return view('bbs.create');
    }

    public function create_thread(ThreadRequest $request) {
        /*
         * スレッドを作成する
         */
        $thread = new Thread();
        $thread->title = $request->title;
        $thread->save();
        $last_insert_id = $thread->id;
        $post = new Post();
        $post->thread_id = $last_insert_id;
        $post->name = $request->name;
        $post->comment = $request->comment;
        $post->save();

        return redirect('/bbs');
    }

    public function store(BbsRequest $request) {
        /*
         * コメントをデータベースに登録する処理を書く
         */
        $post = new Post();
        $post->thread_id = $request->thread_id;
        $post->name = $request->name;
        $post->comment = $request->comment;
        $post->save();

        return redirect()->back();
    }

    public function show(Request $request) {
        /*
         * 指定されたIDのスレッドを表示する
         */
        $validator = Validator::make($request->query(), [
            'id' => 'exists:threads,id'
        ]);
        if($validator->fails()) {
            return '無効なスレッドIDです';
        }

        //スレッド作成者のコメントID
        $first_id = Post::where('thread_id', $request->id)->first()->id;
        //スレッド作成者のコメントオブジェクト
        $first_comment = Post::where('id', $first_id)->first();

        //コメントの数をチェック
        $check = Post::where('thread_id', $request->id)
            ->whereNotIn('id', [$first_id])
            ->exists();

        if($check) {
            //スレッド作成者のコメントを除いたコメントを降順で取り出す
            $posts = Post::where('thread_id', $request->id)
                ->whereNotIn('id', [$first_id])
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $posts = [];
        }

        return view('bbs.show', [
            "first_comment" => $first_comment,
            "thread_id" => $request->id,
            "posts" => $posts
        ]);
    }
}

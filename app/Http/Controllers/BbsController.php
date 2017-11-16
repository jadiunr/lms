<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Post;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BbsRequest;
use App\Http\Requests\ThreadRequest;
use Validator;
use Illuminate\Support\Facades\Auth;

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
        $thread->category_id = $request->category;
        $thread->save();
        $last_insert_id = $thread->id;
        $post = new Post();
        $post->thread_id = $last_insert_id;
        $post->user_id = Auth::user()->id;
        $post->comment = $request->comment;
        $post->save();

        return redirect('/bbs');
    }

    public function store(BbsRequest $request) {
        /*
         * コメントをデータベースに登録する処理を書く
         * 解決済みの場合はエラーを返す処理が必要だがまだ実装していない
         */
        $post = new Post();
        $post->thread_id = $request->thread_id;
        $post->user_id = Auth::user()->id;
        $post->comment = $request->comment;
        $post->save();

        $request->session()->flash('message','投稿しました');
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

        //閲覧者が質問の投稿者かどうかを判定するため
        $user_id = Auth::user()->id;

        return view('bbs.show', [
            "first_comment" => $first_comment,
            "thread_id" => $request->id,
            "posts" => $posts,
            "user_id" => $user_id
        ]);
    }

    public function solved(Request $request) {
        /*
         * 質問を解決済みにする
         * 質問の投稿者IDとの照合が必要だがまだ実装していない
         */
        $thread = Thread::where('id', $request->thread_id)->first();
        $thread->solved = true;
        $thread->save();

        return redirect()->back();
    }

    public function reopen(Request $request) {
        /*
         * 質問を未解決に戻す
         * 質問の投稿者IDとの照合が必要だがまだ実装していない
         */
        $thread = Thread::where('id', $request->thread_id)->first();
        $thread->solved = false;
        $thread->save();

        return redirect()->back();
    }

    public function search(Request $request) {
        /*
         * 検索機能
         */
        if($request->key_w) {
            $threads = Thread::where('title','LIKE',"%$request->key_w%")
                ->orderBy('id','desc')
                ->get();
        } else {
            return redirect()->back();
        }

        return view('bbs.search', [
            "key_w" => $request->key_w,
            "threads" => $threads
        ]);
    }
}

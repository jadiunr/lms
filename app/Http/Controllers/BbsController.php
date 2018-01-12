<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Post;
use App\Thread;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BbsRequest;
use App\Http\Requests\ThreadRequest;
use Validator;
use Illuminate\Support\Facades\Auth;
use Mail;

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

        //管理者のメールアドレスを取得
        $admin_users = User::where('admin', true)->get();

        //タイトル
        $title = $request->title;

        //メール送信
        foreach ($admin_users as $admin_user) {
            Mail::send('emails.new_thread', ['title' => $title, 'url' => "http://laravel.test/bbs/show?id={$thread->id}"], function ($message) use ($title, $admin_user) {
                $message->to($admin_user->email)->subject("新しい質問が投稿されました。タイトル:{$title}");
            });
        }

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

        //関連する質問
        $category_id = $first_comment->thread->category_id;
        $related_threads = Thread::where('category_id', $category_id)
            ->whereNotIn('id', [$request->id])
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('bbs.show', [
            "first_comment" => $first_comment,
            "thread_id" => $request->id,
            "posts" => $posts,
            "user_id" => $user_id,
            "related_threads" => $related_threads
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
        $query = Thread::query();

        $query->where('title','LIKE',"%$request->key_w%");

        //質問の状態で絞る
        if($request->solved != 'all'){
            $query->where('solved',$request->solved);
        }

        //質問のカテゴリで絞る
        if($request->category_id != 'all'){
            $query->where('category_id',$request->category_id);
        }

        $threads = $query
            ->latest('updated_at')
            ->get();

        return view('bbs.search', [
            "key_w" => $request->key_w,
            "threads" => $threads
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Changelog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //最新のスレッド4件を取得
        $threads = Thread::latest('updated_at')
            ->orderBy('id','desc')
            ->take(4)
            ->get();

        //新着情報
        $changelog = Changelog::orderBy('id','desc')
            ->take(5)
            ->get();

        return view('home',compact('changelog'),compact('threads'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

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
        //最新のスレッド三件を取得
        $threads = Thread::latest('updated_at')
            ->take(4)
            ->get();

        return view('home', compact('threads'));
    }
}

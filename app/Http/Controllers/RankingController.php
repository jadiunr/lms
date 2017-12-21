<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function total()
    {
        $flag = 0;

        $block_id = DB::table('problems')
            ->select(DB::raw('block_id'))
            ->distinct()
            ->get();

        $users = User::all();

        $records = DB::table('records')
            ->select(DB::raw('user_id , sum(total) as total'))
            ->groupBy('user_id')
            ->orderBy('total','desc')
            ->get();

        return view('/ranking')
            ->with(compact('block_id','records','users','flag'));
    }

    public function percentage(Request $request)
    {
        $flag = 1;

        $block = $request->block_id;
        $block_id = DB::table('problems')
            ->select(DB::raw('block_id'))
            ->distinct()
            ->get();

        $users = User::all();

        $records = DB::table('records')
            ->select(DB::raw('user_id , max(total/80*100) as total'))
            ->where('block',$block)
            ->groupBy('user_id')
            ->orderBy('total','desc')
            ->get();

        return view('/ranking')
            ->with(compact('block_id','records','users','flag','block'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Exam;
use App\Block;

class RankingController extends Controller
{
    public function total()
    {
        $flag = 0;

        $exam = null;

        $block = null;

        $exam_id = Exam::all();

        $block_id = Block::all();

        $users = User::all();

        $records = DB::table('records')
            ->select(DB::raw('user_id , sum(total) as total'))
            ->groupBy('user_id')
            ->orderBy('total','desc')
            ->get();

        return view('/ranking')
            ->with(compact('exam_id','block_id','records','users','flag','exam','block'));
    }

    public function percentage(Request $request)
    {
        $flag = 1;

        $exam = $request->exam_id;

        $block = $request->block_id;

        $exam_id = Exam::all();

        $block_id = Block::all();

        $users = User::all();

        $records = DB::table('records')
            ->select(DB::raw('user_id , max(total/80*100) as total'))
            ->where('exam_id','=',$exam)
            ->where('block_id','=',$block)
            ->groupBy('user_id')
            ->orderBy('total','desc')
            ->get();

        return view('/ranking')
            ->with(compact('exam_id','block_id','records','users','flag','block','exam','block'));
    }
}

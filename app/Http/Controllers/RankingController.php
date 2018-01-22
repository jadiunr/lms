<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Exam;

class RankingController extends Controller
{
    function view(Request $request)
    {
        $users = DB::select("select user_id, sum(total) total from records group by user_id order by total desc");

        $names=function($index){

            $name=User::where('id',$index)->get()->first();

            return $name;
        };

        $exams=Exam::all();
        $null=1;
        $exam_id=$request->select;
        $exam_name=Exam::where('id',$exam_id)->get();
        if(isset($exam_id)){
//                $users = DB::select("select user_id, avg(rate) rate from records group by user_id order by rate desc");
            $null = NULL;
            $users = DB::table('records')
                ->select(DB::raw('user_id , avg(rate) as rate'))
                ->where('exam_id', '=', $exam_id)
                ->groupBy('user_id')
                ->orderBy('rate','desc')
                ->get();
        }



        return view('ranking', ['users' => $users,'exams'=>$exams,'names'=>$names,'null'=>$null,'exam_name'=>$exam_name]);
    }

}
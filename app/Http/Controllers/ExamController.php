<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
class ExamController extends Controller
{
    //
    function index($exam_id){

        return view('posts.top',['exam_id'=>$exam_id]);
    }



    function learn($exam_id){

        $post=DB::table('problems')->where('class',$exam_id)->get();
        $id=1;

        return view('posts.learning')->with(['problem_number'=>$post[0],'Previous_btn'=>$id,'Next_btn'=>$id+1,'exam_id'=>$exam_id]);
    }



    function learn_id($exam_id,$id){
        $post=DB::table('problems')->where('class',$exam_id)->get();
        $problem_Previous = DB::table('problems')->where('id', $id)->first();
        $problem_Next = DB::table('problems')->where('id', $id+1)->first();

        //次,前 問題のボタン処理

        if(is_null($problem_Previous) or $id==1){
            $Previous_btn=$id;
        }else{
            $Previous_btn=$post[$id-2]->id;
        }
        if(is_null($problem_Next) or $id==80) {
            $Next_btn = $id;
        }else{
            $Next_btn = $post[$id]->id;
        }

        if(is_null($problem_Previous)){
            $error="問題が設定されていません。こちらのサービス提供に不手際がありました。申し訳ございませんでした。<br>全ての問題はこちらの会社のCEO<strong style=\"color: red\">MIZUKAMI</strong>の責任";
            return view('posts.learning')->with(['error'=>$error,'problem_number'=>$post[0],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id]);
        }

        return view('posts.learning')->with(['problem_id'=>$post[$id-1],'problem_number'=>$post[$id-1],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id]);
    }




    function answer($exam_id,$problem_id,$answer){

            $problem_answer = DB::table('problems')->where('id',$problem_id)->where('class',$exam_id)->first();


            if($problem_answer->explain == $answer){
                return redirect('/'.$exam_id.'/exam/learning/'.$problem_id)->with('flash_message', 'Great!');
            }

            return redirect('/'.$exam_id.'/exam/learning/'.$problem_id)->with('flash_message', 'Fuck!');

    }


}
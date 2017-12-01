<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
class ExamController extends Controller
{


    function block($exam_id){


     return view('posts.block_list',['exam_id'=>$exam_id]);
    }
    //
    function index($exam_id,$block_id){

        return view('posts.top',['exam_id'=>$exam_id,'block_id'=>$block_id]);
    }



    function learn($exam_id,$block_id,$mode_id){

        $post=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->orderBy('problem_number')->get();
        $id=1;

        if($mode_id=="test")
        {

            return view('posts.test')->with(['problem_id'=>$post[0],'Previous_btn'=>$id,'Next_btn'=>$id+1,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id]);

        }


        return view('posts.learning')->with(['problem_id'=>$post[0],'Previous_btn'=>$id,'Next_btn'=>$id+1,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id]);
    }

    function learn_id($exam_id,$block_id,$mode_id,$id){
        $post=DB::table('problems')->where('exam_id',$exam_id)->get();
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
            return view('posts.learning')->with(['error'=>$error,'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id]);
        }
        if($mode_id=="test"){

            $session_item=session()->get('answers_test',[]);

            return view('posts.test')->with(['problem_id'=>$post[$id-1],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id,'session_item'=>$session_item]);

        }

        return view('posts.learning')->with(['problem_id'=>$post[$id-1],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id]);
    }




    function answer($exam_id,$block_id,$mode_id,$problem_id,$answer){

            if($mode_id=="learning") {

                $answers=session()->get('answers',[]);

                if(empty($answers)) {
                    for ($i = 0; $i < 80; $i++) {
                        $answers[$i] = "-";
                    }
                }

                $answers[$problem_id-1]=$answer;

                session()->put('answers',$answers);

                $problem_answer = DB::table('problems')->where('exam_id',$exam_id)->where('problem_number',$problem_id)->first();

                $problem_id++;

                if ($problem_answer->correct == $answer) {
                    return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id)->with('flash_message', 'Great!');
                }

                return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id)->with('flash_message', 'Fuck!');
            }

            $answers_test=session()->get('answers_test',[]);

            if(empty($answers_test)) {
                for ($i = 0; $i < 80; $i++) {
                    $answers_test[$i] = "-";
                }
            }

            $answers_test[$problem_id-1]=$answer;

            session()->put('answers_test',$answers_test);

            $problem_id++;


            return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id);

    }

    function answer_list($exam_id,$block_id,$mode_id){

        $post=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->orderBy('problem_number')->get();

        $session_item=session()->get('answers',[]);

        if(empty($session_item)) {
            for ($i = 0; $i < 80; $i++) {
                $session_item[$i] = "-";
            }
        }

        if($mode_id=="test"){
            $answers_test=session()->get('answers_test',[]);

            if(empty($answers_test)) {
                for ($i = 0; $i < 80; $i++) {
                    $answers_test[$i] = "-";
                }
            }
            $b=0;
            foreach ($answers_test as $index => $item){
                if($post[$index]->correct==$item){
                    $b++;
                }
            }
            $result=$b/80*100;
            return view('posts.Test_results',['correct_count'=>$b,'result'=>$result,'problem_id'=>$post,'session_item'=>$answers_test,
                "judgment"=>function($index,$correct){
                    if($index == $correct){
                        return "○";
                    }
                    return "×";


                }]);
        }
         return view('posts.answer_list',["exam_id"=>$exam_id,"correct"=>$post,"session_item"=>$session_item,
             "judgment"=>function($index,$correct){
                  if($index == $correct){
                      return "○";
                  }
                  return "×";


             }]);


    }



}

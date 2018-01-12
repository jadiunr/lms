<?php

namespace App\Http\Controllers;

use App\Block;
use App\Problem;
use Beta\B;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Record;
use App\Answer;
use App\Exam;
class ExamController extends Controller
{
    //試験選択
    function getExams() {
        $exam_list=Exam::all();
        return view('posts.exam_list',['exam_list'=>$exam_list]);
    }

    //最初から始める
    function start(Request $request, $exam_id, $block_id, $mode_id) {
        /*
         * ラーニングモードとテストモード開始時にセッションを破棄する
         */
        if($mode_id == 'learning'){
            $request->session()->forget('answers');

            return redirect()->to("/exam/{$exam_id}/{$block_id}/{$mode_id}/1");
        }else if($mode_id == 'test'){
            $request->session()->forget('answers_test');

            return redirect()->to("/exam/{$exam_id}/{$block_id}/{$mode_id}/1");
        }else{
            return 'そんなモードないです';
        }
    }

    function block($exam_id){

        $block_list = Block::getBindingBlocks($exam_id);

     return view('posts.block_list',['exam_id'=>$exam_id,'block_list'=>$block_list]);
    }

    function index($exam_id,$block_id){

        return view('posts.top',['exam_id'=>$exam_id,'block_id'=>$block_id]);
    }


    function learn_id($exam_id,$block_id,$mode_id,$id){



        $post=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->get();
        $problem_Previous = DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->where('problem_number', $id)->first();
        $problem_Next = DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->where('problem_number', $id+1)->first();
        $problem_count=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->count();

        //次,前 問題のボタン処理
        if(is_null($problem_Previous) or $id==1){
            $Previous_btn=$id;
        }else{
            $Previous_btn=$post[$id-2]->problem_number;
        }
        if(is_null($problem_Next) or $id==$problem_count) {
            $Next_btn = $id;
        }else{
            $Next_btn = $post[$id]->problem_number;
        }

        $session_item=session()->get('answers',[]);

        if(is_null($problem_Previous)){
            $error="問題が設定されていません。こちらのサービス提供に不手際がありました。申し訳ございませんでした。<br>全ての問題はこちらの会社のCEO<strong style=\"color: red\">MIZUKAMI</strong>の責任";
            return view('posts.learning')->with(['error'=>$error,'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id]);
        }
        if($mode_id=="test"){
            $session_item=session()->get('answers_test',[]);


            return view('posts.test')->with(['problem_id'=>$post[$id-1],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id,'session_item'=>$session_item,'id'=>$id,'problem_count'=>$problem_count]);

        }

        return view('posts.learning')->with(['problem_id'=>$post[$id-1],'Previous_btn'=>$Previous_btn,'Next_btn'=>$Next_btn,'exam_id'=>$exam_id,'block_id'=>$block_id,'mode_id'=>$mode_id,'id'=>$id,'session_item'=>$session_item,'problem_count'=>$problem_count]);
    }




    function answer($exam_id,$block_id,$mode_id,$problem_id,$answer){

            if($mode_id=="learning") {

                $answers=session()->get('answers',[]);

                $answers[$problem_id-1]=$answer;

                session()->put('answers',$answers);

                $problem_answer = DB::table('problems')->where('exam_id',$exam_id)->where('problem_number',$problem_id)->first();


                if ($problem_answer->correct == $answer) {
                    return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id)->with('flash_message', '正解です！');
                }

                return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id)->with('flash_message', '残念、不正解です...');
            }

            $answers_test=session()->get('answers_test',[]);

            $answers_test[$problem_id-1]=$answer;

            session()->put('answers_test',$answers_test);

            return redirect('/exam/' . $exam_id . '/' . $block_id . '/' . $mode_id . '/' . $problem_id)->with('flash_message', '記録しました。');

    }

    function answer_list($exam_id,$block_id,$mode_id){

        $post=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->orderBy('problem_number')->get();

        $session_item=session()->get('answers',[]);

        $judgment= function ($index, $correct) {
            if ($index == $correct) {
                return "○";
            }
            return "×";


        };

        if($mode_id=="test"){
            $answers_test = session()->get('answers_test', []);

            $b = 0;
            $technology=0; $management=0; $strategy=0; $etc=0;
            foreach ($answers_test as $index => $item) {
                if ($post[$index]->correct == $item) {
                    $b++;
                    switch ($post[$index]->category_id){
                        case 1: $technology++; break;
                        case 2: $management++; break;
                        case 3: $strategy++;   break;
                        case 4: $etc++;
                    }
                }
            }
            $records = new Record();
            $records->user_id=\Auth::user()->id;
            $records->block_id = $block_id;
            $records->exam_id = $exam_id;
            $records->category1 = $technology;
            $records->category2 = $management;
            $records->category3 = $strategy;
            $records->category4 = $etc;
            $records->total = $b;
            $records->rate = ($b / Problem::where('exam_id', '=', $exam_id)
                    ->where('block_id', '=', $block_id)
                    ->count()) * 100;
            $records->save();

            foreach ($answers_test as $index => $answer) {
                $answer_table = new Answer();
                $answer_table->user_id = \Auth::user()->id;
                $answer_table->problem_id = $post[$index]->id;
                $answer_table->answer = $answer;
                $answer_table->record_id = $records->id;
                $answer_table->save();
            }

            $problem_count=DB::table('problems')->where('exam_id',$exam_id)->where('block_id',$block_id)->count();

            $result = $b / $problem_count * 100;

            return view('posts.Test_results',['correct_count'=>$b,'result'=>$result,'problem_id'=>$post,'session_item'=>$answers_test,
                "judgment"=>$judgment]);
        }
         return view('posts.answer_list',["exam_id"=>$exam_id,"correct"=>$post,"session_item"=>$session_item,
             "judgment"=>$judgment]);


    }



}

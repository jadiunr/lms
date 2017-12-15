<?php


//
namespace App\Http\Controllers;
use App\Category;
use App\Answer;
use App\Problem;
use App\Record;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RecordController extends Controller
{
    //
    public  function view($exam_id)
    {


        $user = Auth::id();
        $answers = Answer::where('user_id', $user)->get();

        $record =Record::where('user_id',$user)->where('exam_id',$exam_id)->get();
        $null_set=Record::where('user_id',$user)->where('exam_id',$exam_id)->first();

        if(is_null($null_set)){

            $null='テスト受験履歴がありません。';


            return view('posts.result',['null'=>$null]);
        }

        $total_technology=0; $total_management=0; $total_strategy=0; $total_etc=0;
        //現在までのカテゴリーごとの正答数の合計

        foreach ($record as $category){
            $total_technology +=$category->category1;
            $total_management +=$category->category2;
            $total_strategy   +=$category->category3;
            $total_etc        +=$category->category4;
        }
        $q=0;$w=0;$e=0;$r=0;
//        問題の中のカテゴリカウント
        foreach ($answers as $index => $answer) {
            $problem_id = $answer->problem_id;
            $problem = Problem::where('id',$problem_id)->where('exam_id',$exam_id)->get();
            $problem_null = Problem::where('id',$problem_id)->where('exam_id',$exam_id)->first();
            if(is_null($problem_null)){
                continue;

            }else{
                $category_id = $problem[0]->category_id;
                //カテゴリをカウント
                switch ($category_id) {
                    case 1:$q++;break;//テクノロジー
                    case 2:$w++;break;//マネジメント
                    case 3:$e++;break;//ストラテジー
                    case 4:$r++;break;//その他
                }
            }
        }

        //問題の中のカテゴリ中の正答率を計算

        $a=$total_technology/$q*100;
        $b=$total_management/$w*100;
        $c=$total_strategy/$e*100;
        $d=$total_etc/$r*100;

        $answer_rate = array($a,$b,$c,$d);


        return view('posts.result',['records'=>$record,'answer_rate'=>$answer_rate]);
    }
    public function history($exam_id,$time){
        $history = Record::where('created_at',$time)->where('user_id',\Auth::user()->id)->get();

        $answer_history=Answer::where('record_id',$history[0]->id)->get();

        $problem= Problem::where('block_id',$history[0]->year)->where('exam_id',$history[0]->exam_id)->orderBy('problem_number')->get();



        return view('posts.result_history',['answer_history'=>$answer_history,'problems'=>$problem,
            'judgement'=> function($a,$b){
                if($a==$b){
                    return "○";
                }
                return "×";

            }]);


    }




}



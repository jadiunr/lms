<?php


//
namespace App\Http\Controllers;
use App\Category;
use App\Answer;
use App\Problem;
use App\Record;
use App\Exam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
class RecordController extends Controller
{
    //
    public  function view(Request $request,$exam_id)
    {
        $request->flashOnly(['start_period', 'end_period']);

        $user = Auth::id();
        $answers = Answer::where('user_id', $user)->get();
        $exam_list=Exam::all();

        $current_exam_name = Exam::findOrFail($exam_id)->name;

        $record =Record::where('user_id',$user)->where('exam_id',$exam_id)->get();
        $null_set=Record::where('user_id',$user)->where('exam_id',$exam_id)->first();

        if(is_null($null_set)){

            $null='テスト受験履歴がありません。';


            return view('posts.result',['null'=>$null,'current_exam_name'=>$current_exam_name,'exam_id'=>$exam_id,'exam_list'=>$exam_list]);
        }



        //期間指定カテゴリー成績参照処理
        $max_date=date("Y-m-d");
        $start_period=$request->start_period;
        $end_period=$request->end_period;
        $dt1 = new Carbon($start_period);
        $dt2 = new Carbon($end_period);

        $period_error=false;
        if($dt1->gt($dt2)==true){
           $period_error=true;
        }


        if(isset($start_period) and isset($end_period)) {
            $record = Record::where('user_id',$user)->where('exam_id',$exam_id)->whereBetween('created_at', [$start_period.' 00:00:00', $end_period.' 23:59:59'])->get();
            $answers = Answer::where('user_id', $user)->whereBetween('created_at', [$start_period.' 00:00:00', $end_period.' 23:59:59'])->get();

            $record_null_set=Record::where('user_id',$user)->where('exam_id',$exam_id)->whereBetween('created_at', [$start_period.' 00:00:00', $end_period.' 23:59:59'])->first();


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
        $a=0;$b=0;$c=0;$d=0;
        //問題の中のカテゴリ中の正答率を計算
        if(isset($record_null_set)){
        $a = $total_technology / $q * 100;
        $b = $total_management / $w * 100;
        $c = $total_strategy / $e * 100;
        $d = $total_etc / $r * 100;
        };

        $answer_rate = array($a,$b,$c,$d);

        return view('posts.result',['records'=>$record,'answer_rate'=>$answer_rate,'current_exam_name'=>$current_exam_name,'exam_id'=>$exam_id,'max_date'=>$max_date,'exam_list'=>$exam_list,'period_error'=>$period_error]);
    }
    public function history($exam_id,$time){
        $history = Record::where('created_at',$time)->where('user_id',\Auth::user()->id)->get();

        $answer_history=Answer::where('record_id',$history[0]->id)->get();

        $problem= Problem::where('block_id',$history[0]->block_id)->where('exam_id',$history[0]->exam_id)->orderBy('problem_number')->get();



        return view('posts.result_history',['time'=>$time,'exam_id'=>$exam_id,'answer_history'=>$answer_history,'problems'=>$problem,
            'judgement'=> function($a,$b){
                if($a==$b){
                    return "○";
                }
                return "×";

            }]);


    }
    public function details($exam_id,$time,$problem_id) {

        $question = Problem::where('id',$problem_id)->get();

        return view('posts.history_details',['exam_id'=>$exam_id,'time'=>$time,'question'=>$question[0]]);

    }





}



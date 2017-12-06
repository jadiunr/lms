<?php


//
namespace App\Http\Controllers;
    use App\Category;
    use App\Answer;
    use App\Problem;
    use App\record;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;


class RecordController extends Controller
{
    //
    public  function view()
    {
        $user = Auth::id();
        $answers = Answer::where('user_id', $user)->get();

            $record =Record::where('user_id',$user)->get();

        $total_technology=0; $total_management=0; $total_strategy=0; $total_etc=0;
        $categorys= Record::all();
        //現在までのカテゴリーごとの正答数の合計
        foreach ($categorys as $category){
            $total_technology +=$category->category1;
            $total_management +=$category->category2;
            $total_strategy   +=$category->category3;
            $total_etc        +=$category->category4;
        }
        $q=0;$w=0;$e=0;$r=0;
//        問題の中のカテゴリカウント
        foreach ($answers as $index => $answer) {
            $problem_id = $answer->problem_id;
            $problem = Problem::find($problem_id);
            $category_id = $problem->category_id;

            //カテゴリをカウント
            switch ($category_id) {
                case 1:$q++;break;//テクノロジー
                case 2:$w++;break;//マネジメント
                case 3:$e++;break;//ストラテジー
                case 4:$r++;break;//その他
            }
        }
        //問題の中のカテゴリ中の正答率を計算

        $a=$total_technology/$q*100;
        $b=$total_management/$w*100;
        $c=$total_strategy/$e*100;
        $d=$total_etc/$r*100;

        $answer_rate = array($a,$b,$c,$d);


        return view('record',['records'=>$record,'answer_rate'=>$answer_rate]);
    }



}




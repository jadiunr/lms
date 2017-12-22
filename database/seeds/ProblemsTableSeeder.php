<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Problem;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $questions[]=collect(["流れ図は，シフト演算と加算の繰り返しによって，2進整数の乗算を行う手順を表したものである。この流れ図中のa，bの組合せとして，適切なものはどれか。ここで，乗数と被乗数は符号なしの16ビットで表される。X，Y，Zは32ビットのレジスタであり，けた送りは論理シフトを用いる。最下位ビットを第0ビットと記す。",
                              "動作クロック周波数が700MHzのCPUで，命令の実行に必要なクロック数とその命令の出現率が表に示す値である場合，このCPUの性能は約何MIPSか。",
                              "稼働率Rの装置を図のように接続したシステムがある。このシステム全体の稼働率を表わす式はどれか。ここで，並列に接続されている部分はどちらかの装置が稼働していれば良く，直列に接続されている部分は両方の装置が稼働していなければならない。",
                              "仮想記憶方式のコンピュータにおいて，実記憶に割り当てられるページ数は3とし，追い出すページを選ぶアルゴリズムは，FIFOとLRUの二つ考える。あるタスクのページアクセス順序が
　　                             1, 3, 2, 1, 4, 5, 2, 3, 4, 5
                               のとき，ページを置き換える回数の組合せとして適切なものはどれか。"]);
        for ($i=1;$i<17;$i++) {
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }
            $category = $i%4==0 ? 4 : $i%4;
            if($i<5 or ($i>=9 and $i<13)){
                $block_id='H25_s';
            }elseif (($i>=5 and $i<9) or ($i>=13 and $i<17)){
                $block_id='H25_a';
            }
            if($i<5){
                $problem_number=$i;
            }elseif($i>=5 and $i<9){
                $problem_number=$i-4;
            }elseif ($i>=9 and $i<13){
                $problem_number=$i-8;
            }else{
                $problem_number=$i-12;
            };
            $exam_id=$i<9 ? 'FE':'AP';
            if($i<5){$q=$i-1;}elseif ($i>=5 and $i<9){$q=$i-5;}elseif ($i >=9 and $i<13){$q=$i-9;}else{$q=$i-13;};

            if($i<5){$q_pic=$i;}elseif ($i>=5 and $i<9){$q_pic=$i-4;}elseif ($i >=9 and $i<13){$q_pic=$i-8;}else{$q_pic=$i-12;};
            $q_ans=$i%4==0 ? '/files/1/selected_1.gif':"NULL";

            Problem::create([
                'exam_id'=>$exam_id,
                'block_id'=>$block_id,
                'category_id'=> $category,
                'problem_number'=> $problem_number,
                'question'=> $questions[0][$q],
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> $q_pic==4 ? "NULL":'/files/1/'.$q_pic.'.gif',
                'pic_ans'=> $q_ans,
                'explain' => 'aaa',
                'correct' => $correct
            ]);
        }
        for ($i = 5; $i < 157; $i++) {
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }
            $category = $i%4==0 ? 4 : $i%4;
            $block_id = $i<81 ? 'H25_s': 'H25_a';
            $problem_number = $i>=81 ? $i-76:$i;
            Problem::create([
                'exam_id'=>'FE',
                'block_id'=>$block_id,
                'category_id'=> $category,
                'problem_number'=> $problem_number,
                'question'=> 'dummyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$i,
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> 'NULL',
                'pic_ans'=> 'NULL',
                'explain' => 'aaa',
                'correct' => $correct
            ]);
        }
        for ($i = 5; $i < 157; $i++){
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }
            $category = $i%4==0 ? 4 : $i%4;
            $block_id = $i<81 ? 'H25_s': 'H25_a';
            $problem_number = $i>=81 ? $i-76:$i;
            Problem::create([
                'exam_id'=>'AP',
                'block_id'=>$block_id,
                'category_id'=> $category,
                'problem_number'=> $problem_number,
                'question'=> 'dummyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$i,
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> 'NULL',
                'pic_ans'=> 'NULL',
                'explain' => 'aaa',
                'correct' => $correct
            ]);
        }
    }
}
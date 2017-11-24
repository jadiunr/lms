<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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

       $problems= array(
           array('exam_id'=>'FE',
               'block_id'=>'H25_s',
               'category_id'=>0,
               'problem_number'=>1,
               'question' => '回転数が4,200回／分で，平均位置決め時間が5ミリ秒の磁気ディスク装置がある。この磁気ディスク装置<br>の平均待ち時間は約何ミリ秒か。ここで，平均待ち時間は，平均位置決め時間と平均回転待ち時間の合計<br>である。',
               'answer1'=>'7',
               'answer2'=>'10',
               'answer3'=>'12',
               'answer4'=>'14',
               'pic_que'=>'',
               'pic_ans'=>'',
               'explain' => '平均位置決め時間は5ミリ秒とわかっているので、平均回転待ち時間を正しく計算することがこの問題を解<br>く鍵となります。<br>平均回転待ち時間は、ディスクが1回転に要する時間の1／2です。<br>60,000ミリ秒÷4200回転÷2＝7.1428…(ミリ秒)<br>したがってこの磁気ディスク装置の平均待ち時間は、平均位置決め時間は5ミリ秒と、平均回転待ち時間約7<br>ミリ秒を足した 約12ミリ秒 となります。',
               'correct' =>  'ウ'),
           array('exam_id'=>'FE',
               'block_id'=>'H25_s',
               'category_id'=>0,
               'problem_number'=>2,
               'question'=> 'コンピュータシステムによって単位時間当たりに処理される仕事の量を表す用語はどれか。',
               'answer1'=>'スループット',
               'answer2'=>'ターンアラウンドタイム',
               'answer3'=>'タイムスライス',
               'answer4'=>'レスポンスタイム',
               'pic_que'=>'',
               'pic_ans'=>'',
               'explain' => 'スループット(Throughput)は、システムで単位時間当たりに処理される仕事の量を表す言葉です。データ<br>処理におけるスループットには、コンピュータに搭載されるCPUのクロック周波数やハードディスクの回<br>転速度、OSなど、様々な要因が影響し、システムのパフォーマンスの評価基準となります。',
               'correct' =>  'ア'),
           array('exam_id'=>'FE',
               'block_id'=>'H25_s',
               'category_id'=>0,
               'problem_number'=>3,
               'question'=>'関係を第3正規形まで正規化して設計する目的はどれか。',
               'answer1'=>'値の重複をなくすことによって，格納効率を向上させる。',
               'answer2'=>'関係を細かく分解することによって，整合性制約を排除する。',
               'answer3'=>'冗長性を排除することによって，更新時異状を回避する。',
               'answer4'=>'属性間の結合度を低下させることによって，更新時のロック待ちを減らす。',
               'pic_que'=>'',
               'pic_ans'=>'',
               'explain' =>'正規化の目的は冗長性の排除することで更新時異状を回避し、データベースの一貫性を確保することです。',
               'correct' =>'ウ'

               )
       );

        DB::table('problems')->insert($problems);






    }
}

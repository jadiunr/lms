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
        for ($i = 1; $i < 81; $i++) {
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }

            switch ($i%4){
                case 0:$exam_id="fe";break;
                case 1:$exam_id="ap";break;
                case 2:$exam_id="sc";break;
                case 3:$exam_id="nw";break;
            }

            Problem::create([
                'exam_id'=> $exam_id,
                'block_id'=>'h25_s',
                'category_id'=> 1,
                'problem_number'=> $i,
                'question'=> 'dummyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$i,
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> '',
                'pic_ans'=> '',
                'explain' => 'aaa',
                'correct' => $correct
            ]);
        }

        for ($i = 1; $i < 50; $i++) {
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }

            switch ($i%4){
                case 0:$exam_id="fe";break;
                case 1:$exam_id="ap";break;
                case 2:$exam_id="sc";break;
                case 3:$exam_id="nw";break;
            }

            Problem::create([
                'exam_id'=> 'fe',
                'block_id'=>'h26_s',
                'category_id'=> 1,
                'problem_number'=> $i,
                'question'=> 'dummyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$i,
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> '',
                'pic_ans'=> '',
                'explain' => 'aaa',
                'correct' => $correct
            ]);
        }
    }
}

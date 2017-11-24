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
                case 0:$correct="ア";break;
                case 1:$correct="イ";break;
                case 2:$correct="ウ";break;
                case 3:$correct="エ";break;
            }
            Problem::create([
                'exam_id'=>'FE',
                'block_id'=>'H25_s',
                'category_id'=> 0,
                'problem_number'=> $i,
                'question'=> 'dummyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$i,
                'answer1'=> '1',
                'answer2'=> '2',
                'answer3'=> '3',
                'answer4'=> '4',
                'pic_que'=> '',
                'pic_ans'=> '',
                'explain' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                'correct' => $correct
            ]);
        }
    }
}

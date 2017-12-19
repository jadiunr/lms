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
        $correct = "";
        $exam_ids = [
            'fe' => 'fe',
            'ap' => 'ap',
            'nw' => 'nw',
            'sc' => 'sc'
        ];

        $block_ids = [
            'h25_s' => 'h25_s',
            'h26_s' => 'h26_s',
            'h27_s' => 'h27_s',
            'h28_s' => 'h28_s'
        ];

        foreach($exam_ids as $exam_id) {
            foreach($block_ids as $block_id){
                for ($i = 1; $i < 81; $i++) {
                    switch ($i % 4) {
                        case 0: $correct = "エ";break;
                        case 1: $correct = "ア";break;
                        case 2: $correct = "イ";break;
                        case 3: $correct = "ウ";break;
                    }

                    Problem::create([
                        'exam_id' => $exam_id,
                        'block_id' => $block_id,
                        'category_id' => 1,
                        'problem_number' => $i,
                        'question' => 'Sample Question ' . $i,
                        'answer1' => '1',
                        'answer2' => '2',
                        'answer3' => '3',
                        'answer4' => '4',
                        'pic_que' => '/',
                        'pic_ans' => '/',
                        'explain' => 'aaa',
                        'correct' => $correct
                    ]);
                }
            }
        }
    }
}

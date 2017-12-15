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
            $category = $i%4==0 ? 4 : $i%4;
            Problem::create([
                'exam_id'=>'FE',
                'block_id'=>'H25_s',
                'category_id'=> $category,
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
        for ($i = 1; $i < 81; $i++) {
            switch ($i%4){
                case 0:$correct="エ";break;
                case 1:$correct="ア";break;
                case 2:$correct="イ";break;
                case 3:$correct="ウ";break;
            }
            $category = $i%4==0 ? 4 : $i%4;
            Problem::create([
                'exam_id'=>'AP',
                'block_id'=>'H25_s',
                'category_id'=> $category,
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
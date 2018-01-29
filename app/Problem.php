<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Problem extends Model
{
    public function block(){
        return $this->belongsTo('App\Block');
    }
    public function exam(){
        return $this->belongsTo('App\Exam');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public static function getBindingProblems($exam_id, $block_id){
        $bindingProblems = DB::select('select p.id,
                                              p.problem_number,
                                              p.question,
                                              c.name,
                                              p.created_at,
                                              p.updated_at
                                              from problems p
                                              join categories c on c.id = p.category_id
                                              where p.exam_id = \''.$exam_id.'\' and p.block_id = \''.$block_id.'\'
                                              order by p.problem_number');
        return $bindingProblems;
    }

    public static function getProblemNumbers($exam_id, $block_id){
        $problem_numbers = Problem::select('problem_number')
            ->where('exam_id', '=', $exam_id)
            ->where('block_id', '=', $block_id)
            ->orderBy('problem_number')
            ->get();
        return $problem_numbers->toArray();
    }

    public static function isContinuousProblemNumber(array $problem_numbers){
        $array = [];
        foreach($problem_numbers as $problem_number){
            $array[] = $problem_number['problem_number'];
        }

        return $array // 要素が1つ以上あるか
            && array_filter($array, 'is_int') === $array // 整数以外のものを含んでいないか
            && is_array(json_decode(json_encode($array))) // キーが0からの整数連番で連続しているか
            && $array[0] == 1 //値が1から始まるか
            && range($array[0], $array[0] + count($array) - 1) === $array; // 値が整数連番で連続しているか
    }

}

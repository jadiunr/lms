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
}

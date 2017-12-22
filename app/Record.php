<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    //


    public function answers(){
        return $this->hasMany('App\Answer', 'record_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function block(){
        return $this->belongsTo('App\Block', 'block_id');
    }

    public function exam(){
        return $this->belongsTo('App\Exam', 'exam_id');
    }

    public static function getRecords(){
//        return DB::table('records')
//            ->join('exams', 'exams.id', '=', 'records.exam_id')
//            ->join('blocks', 'blocks.id', 'records.block_id')
//            ->join('users', 'users.id', '=', 'records.user_id')
//            ->join('answers', 'records.id', '=', 'answers.record_id')
//            ->select('records.id as record_id',
//                'exams.name as exam_name',
//                'blocks.name as block_name',
//                'users.name as user_name',
//                'users.realname as user_realname',
//                DB::raw('(records.total / count(answers.record_id)) as rate'),
//                'records.created_at as exam_date')
//            ->groupBy('records.id')
//            ->paginate(10);

        return Record::paginate(10);
    }

    public static function searchRecords($word){
        $query = Record::query();
        $query->whereHas('user', function ($query) use ($word) {
            $query->where('name', 'LIKE', "%$word%")
                ->orWhere('realname', 'LIKE', "%$word%");
        })->orWhereHas('block', function($query) use ($word) {
            $query->where('name', 'LIKE', "%$word%");
        })->orWhereHas('exam', function ($query) use ($word) {
            $query->where('name', 'LIKE', "%$word%");
        });

        return $query->paginate(10);
    }
}
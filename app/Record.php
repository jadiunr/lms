<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    //


    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function getRecords(){
//        return DB::select('select records.id as record_id,
//            exams.name as exam_name,
//            blocks.name as block_name,
//            users.name as user_name,
//            users.realname as user_realname,
//            (records.total / count(answers.record_id)) as rate,
//            records.created_at as exam_date
//            from records
//            join exams on exams.id = records.exam_id
//            join blocks on blocks.id = records.block
//            join users on users.id = records.user_id
//            join answers on records.id = answers.record_id
//            group by records.id
//            ');

        return DB::table('records')
            ->join('exams', 'exams.id', '=', 'records.exam_id')
            ->join('blocks', 'blocks.id', 'records.block')
            ->join('users', 'users.id', '=', 'records.user_id')
            ->join('answers', 'records.id', '=', 'answers.record_id')
            ->select('records.id as record_id',
                'exams.name as exam_name',
                'blocks.name as block_name',
                'users.name as user_name',
                'users.realname as user_realname',
                DB::raw('(records.total / count(answers.record_id)) as rate'),
                'records.created_at as exam_date')
            ->groupBy('records.id')
            ->paginate(10);
    }
}
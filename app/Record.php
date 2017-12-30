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

    public static function searchRecords($word){
        $word = str_replace('　', ' ', $word);
        $word = explode(' ', $word);
        $query = Record::query();
        
        foreach($word as $keyword) {
            if ($keyword == '合格') {
                $query->where('rate', '>=', '60');
            } else if ($keyword == '不合格') {
                $query->where('rate', '<=', '60');
            } else {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%")
                        ->orWhere('realname', 'LIKE', "%$keyword%");
                })->orWhereHas('block', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                })->orWhereHas('exam', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });
            }
        }
        return $query->paginate(10);
    }

    public static function deleteRecord($record_id){
        Record::where('id', $record_id)
            ->delete();
        Answer::where('record_id', $record_id)
            ->delete();
    }
}
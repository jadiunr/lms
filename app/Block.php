<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Block extends Model
{

    public function problems(){return $this->hasMany('App\Problem');}



    protected $keyType = 'string';
    public $incrementing = false;

    public static function getBindingBlocks($exam_id){
        return DB::select('select p.exam_id,
            b.id,
            b.name,
            count(*) as count,
            b.created_at,
            b.updated_at
            from blocks b
            join problems p on b.id = p.block_id and \''. $exam_id .'\'= p.exam_id
            group by b.id, p.exam_id
        ');
    }
}

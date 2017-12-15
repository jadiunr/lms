<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Record;

class Answer extends Model
{

    public function record(){
        return $this->belongsTo('App\Record','record_id');

    }
}

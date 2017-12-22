<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}

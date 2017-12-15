<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //


    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{

    public function problems(){return $this->hasMany('App\Problem');}



    protected $keyType = 'string';
    public $incrementing = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function problems(){return $this->hasMany('App\Problem');}
}

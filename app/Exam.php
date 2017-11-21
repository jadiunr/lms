<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    // 主キーの型をstringに変更する(デフォルトはint)(要検証)
    // 書かなくても動いた
    // protected $keyType = 'string';

    /**
     * モデルの主キーを自動増分させるか否か
     *
     * @var boolean
     */
    public $incrementing = false;
    protected $table = 'exams';
}

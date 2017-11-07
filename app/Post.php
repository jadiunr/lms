<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property int $id
 * @property int $thread_id
 * @property string $name
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Thread $thread
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $touches = ['thread'];

    public function thread() {
        return $this->belongsTo('App\Thread');
    }
}

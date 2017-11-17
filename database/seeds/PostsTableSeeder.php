<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i <= 25;$i++){
            $post = new Post();
            $post->thread_id = $i;
            $post->user_id = 1;
            $post->comment = 'dummy' . $i;
            $post->save();
        }
    }
}

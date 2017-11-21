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

        $post = new Post();
        $post->thread_id = 1;
        $post->user_id = 1;
        $post->comment = '解説が灰色になっててうっすらになってて見にくいのが多々あります。
        学校のPC、スマホでも起こります。
        夜間モードにすれば見れるかもと思ってしたのですが見れませんでした。
        解決お願いします';
        $post->save();

        $post = new Post();
        $post->thread_id = 1;
        $post->user_id = 2;
        $post->comment ='詳しくは分かりませんが、広告ブロックとかがあるとそういう状況になるそうですよ。
        応用情報技術者の掲示板のほうにも同じ質問があったので、参考にされると良いかもしれません' ;
        $post->save();
    }
}

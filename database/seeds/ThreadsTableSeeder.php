<?php

use Illuminate\Database\Seeder;
use App\Thread;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $thread = new Thread();
            $thread->title = '解説が見れない';
            $thread->category_id = 1;
            $thread->save();

    }
}

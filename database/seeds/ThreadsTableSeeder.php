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
        for($i = 1;$i <= 25;$i++){
            $thread = new Thread();
            $thread->title = 'dummy_thread' . $i;
            $thread->save();
        }
    }
}

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
        $thread->title = '得点調整について';
        $thread->save();

        $thread = new Thread();
        $thread->title = '午後のデータベースについて';
        $thread->save();

        $thread = new Thread();
        $thread->title = 'FEとAPの科目について';
        $thread->save();

        $thread = new Thread();
        $thread->title = '午後試験の勉強はどうやっていますか？';
        $thread->save();

        $thread = new Thread();
        $thread->title = 'H24年秋期午後問8のgについて';
        $thread->save();

        for($i = 1;$i <= 10;$i++){
            $thread = new Thread();
            $thread->title = 'dummy_thread' . $i;
            $thread->save();
        }
    }
}

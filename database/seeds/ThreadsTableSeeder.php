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
        $thread->category_id = 4;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'アルゴリズムについて';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = '経常利益について';
        $thread->category_id = 2;
        $thread->save();

        $thread = new Thread();
        $thread->title = '平成27年秋 問8 アルゴリズム質問です';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = '平成25年春期  問79について';
        $thread->category_id = 2;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'H29年春期午前問45について';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'H29年春期午前問30について';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'プロセッサの性能評価に関する計算式';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'おしえてください';
        $thread->category_id = 2;
        $thread->save();

        $thread = new Thread();
        $thread->title = '会場の時計について';
        $thread->category_id = 4;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'H28年秋期午前問16について';
        $thread->category_id = 1;
        $thread->save();

        $thread = new Thread();
        $thread->title = 'IT投資評価と全体最適化策定について';
        $thread->category_id = 3;
        $thread->save();
    }
}

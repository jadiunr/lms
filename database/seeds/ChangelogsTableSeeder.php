<?php

use Illuminate\Database\Seeder;
use App\Changelog;

class ChangelogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('changelogs')->delete();

        $changelog = new Changelog();
        $changelog->content = 'H27年秋基本情報技術者試験午前問題を追加しました。';
        $changelog->save();

        $changelog = new Changelog();
        $changelog->content = 'H28年春基本情報技術者試験午前問題を追加しました。';
        $changelog->save();

        $changelog = new Changelog();
        $changelog->content = 'H28年秋基本情報技術者試験午前問題を追加しました。';
        $changelog->save();

        $changelog = new Changelog();
        $changelog->content = 'H29年春基本情報技術者試験午前問題を追加しました。';
        $changelog->save();

        $changelog = new Changelog();
        $changelog->content = 'H29年秋基本情報技術者試験午前問題を追加しました。';
        $changelog->save();


        


        /*
        $changelog = new Changelog();
        $changelog->content = '';
        $changelog->save();
        */

    }
}

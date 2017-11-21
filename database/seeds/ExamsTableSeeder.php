<?php

use Illuminate\Database\Seeder;
use App\Exam;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['id' => 'fe', 'name' => '基本情報技術者'],
            ['id' => 'ap', 'name' => '応用情報技術者'],
            ['id' => 'sc', 'name' => '情報処理安全確保支援士'],
            ['id' => 'nw', 'name' => 'ネットワークスペシャリスト'],
        ];

        foreach($materials as $material){
            $exam = new Exam();
            $exam->id = $material['id'];
            $exam->name = $material['name'];
            $exam->save();
        }
    }
}

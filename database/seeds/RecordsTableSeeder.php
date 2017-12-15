<?php

use Illuminate\Database\Seeder;
use \App\Record;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('records')->delete();

        $record = new Record();
        $record->user_id = 1;
        $record->year = "H25_s";
        $record->exam_id = "FE";
        $record->category1 = "2";
        $record->category2 = "3";
        $record->category3 = "1";
        $record->category4 = "0";
        $record->total = 6;
        $record->save();

        $record = new Record();
        $record->user_id = 1;
        $record->year = "H26_s";
        $record->exam_id = "FE";
        $record->category1 = "10";
        $record->category2 = "5";
        $record->category3 = "6";
        $record->category4 = "0";
        $record->total = 21;
        $record->save();

        $record = new Record();
        $record->user_id = 2;
        $record->year = "H25_s";
        $record->exam_id = "FE";
        $record->category1 = "5";
        $record->category2 = "2";
        $record->category3 = "2";
        $record->category4 = "0";
        $record->total = 9;
        $record->save();

        $record = new Record();
        $record->user_id = 2;
        $record->year = "H26_s";
        $record->exam_id = "FE";
        $record->category1 = "9";
        $record->category2 = "7";
        $record->category3 = "9";
        $record->category4 = "0";
        $record->total = 25;
        $record->save();




//        $record = new Record();
//        $record->user_id = ;
//        $record->year = "";
//        $record->exam_id = "";
//        $record->category1 = "";
//        $record->category2 = "";
//        $record->category3 = "";
//        $record->category4 = "";
//        $record->total = ;
//        $record->save();
    }
}

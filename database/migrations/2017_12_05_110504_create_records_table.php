<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id',12);//成績ID
            $table->integer('user_id');//ユーザーID
            $table->string('year',12);//年度
            $table->string('exam_id',6);//試験区分
            $table->string('category1',12)->nullable();//カテゴリ
            $table->string('category2',12)->nullable();//カテゴリ
            $table->string('category3',12)->nullable();//カテゴリ
            $table->string('category4',12)->nullable();//カテゴリ
            $table->integer('total');//正解問題数
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}

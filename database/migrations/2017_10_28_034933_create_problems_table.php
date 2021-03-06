<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');  //問題ID
            $table->string('exam_id'); //試験区分
            $table->string('block_id');//試験ブロックID
            $table->integer('category_id');//カテゴリー
            $table->integer('problem_number');//問題番号
            $table->string('question');  //問題
            $table->string('answer1');
            $table->string('answer2');
            $table->string('answer3');
            $table->string('answer4');
            $table->string('pic_que')->nullable();//問題画像
            $table->string('pic_ans')->nullable();//解説画像
            $table->string('correct'); //正解
            $table->string('explain')->nullable(); //解説
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
        Schema::dropIfExists('problems');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //$table->string('user',16)-
            $table->increments('id',12)->unique();//主キー
            $table->string('name',12)->unique();//ユーザー名
            $table->string('password',512);//パスワードハッシュ化されたもの
            $table->string('email',32)->unique();//メールアドレス
            $table->string('icon',80)->nullable();//icon null許可
            $table->boolean('admin')->default('0'); //デフォルトfalse
            $table->timestamps();//更新日
            $table->rememberToken();//?

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

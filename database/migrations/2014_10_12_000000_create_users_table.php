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
            $table->increments('id');
            $table->string('mail_address')->unique()->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->string('name')->comment('ニックネーム');
            $table->string('last_name')->nullable()->comment('姓');
            $table->string('first_name')->nullable()->comment('名');
            $table->string('last_name_kana')->nullable()->comment('姓カナ');
            $table->string('first_name_kana')->nullable()->comment('名カナ');
            $table->string('phone', 11)->nullable()->comment('電話番号');
            $table->char('gender', 1)->nullable()->comment('性別 0:男 2:女');
            $table->char('birthday', 8)->nullable()->comment('生年月日');
            $table->char('address', 2)->nullable()->comment('住所');
            $table->tinyInteger('is_delete')->comment('削除フラグ');
            $table->string('deleted_user')->nullable()->comment('削除者');
            $table->dateTime('deleted_at')->nullable()->comment('削除日時');
            $table->dateTime('created_at')->comment('作成日時');
            $table->dateTime('updated_at')->comment('更新日時');
            $table->rememberToken();
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

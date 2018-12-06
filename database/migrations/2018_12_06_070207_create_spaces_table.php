<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('スペース名');
            $table->integer('main_no')->comment('メイン番号（一番親の番号）');
            $table->integer('tree_no')->comment('ツリー番号（階層）');
            $table->string('comment')->nullable()->comment('コメント');
            $table->integer('capacity')->nullable()->comment('容量');
            $table->integer('category_id')->comment('カテゴリID');
            $table->tinyInteger('is_show')->comment('表示フラグ');
            $table->tinyInteger('is_delete')->comment('削除フラグ');
            $table->string('deleted_user')->nullable()->comment('削除者');
            $table->dateTime('deleted_at')->nullable()->comment('削除日時');
            $table->string('created_user')->comment('作成者');
            $table->dateTime('created_at')->comment('作成日時');
            $table->string('updated_user')->comment('更新者');
            $table->dateTime('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaces');
    }
}

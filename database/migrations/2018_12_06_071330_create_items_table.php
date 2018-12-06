<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('space_id')->comment('スペースID');
            $table->string('name')->comment('アイテム名');
            $table->string('description')->nullable()->comment('説明');
            $table->integer('usage_id')->nullable()->comment('用途');
            $table->integer('count')->nullable()->comment('アイテム数');
            $table->string('category_id')->comment('カテゴリID');
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
        Schema::dropIfExists('items');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // 自動増分ID
            $table->string('title'); // タイトル
            $table->text('content'); // 投稿内容
            $table->timestamps(); // created_at および updated_at タイムスタンプ
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

?>
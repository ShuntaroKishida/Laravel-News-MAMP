<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // 自動増分ID
            $table->unsignedBigInteger('post_id'); // posts テーブルとの外部キー
            $table->text('content'); // コメント内容
            $table->timestamps(); // created_at および updated_at タイムスタンプ

            // posts テーブルとの外部キー制約
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

?>
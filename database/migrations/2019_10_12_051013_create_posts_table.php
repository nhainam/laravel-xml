<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('category_id')->nullable();
            $table->string('channel_id');
            $table->integer('user_id');
            $table->longText('description')->nullable();
            $table->string('comments')->nullable();
            $table->string('published_date')->nullable();
            $table->string('link')->nullable();
            $table->string('guid')->nullable();
            $table->boolean('is_permalink')->default(false);
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
        Schema::dropIfExists('posts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('category_id')->nullable();
            $table->integer('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->dateTime('last_build_date')->nullable();
            $table->dateTime('published_date')->nullable();
            $table->string('category_domain')->nullable();
            $table->string('copyright')->nullable();
            $table->string('docs')->nullable();
            $table->string('language')->nullable();
            $table->string('managing_editor')->nullable();
            $table->string('web_master')->nullable();
            $table->string('generator')->nullable();
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
        Schema::dropIfExists('channels');
    }
}

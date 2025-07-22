<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('new_and_media_category_id');
            $table->longText('title');
            $table->string('slug')->unique();
            $table->unsignedInteger('year_id')->nullable();
            $table->string('location')->nullable();
            $table->longText('content')->nullable();
            $table->date('post_date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('new_and_media_category_id')->references('id')->on('news_and_media_categories')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_rooms');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_stories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('new_and_media_category_id');
            $table->text('title');
            $table->longText('sub_title')->nullable();
            $table->longText('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('image')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('new_and_media_category_id')->references('id')->on('news_and_media_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_stories');
    }
}

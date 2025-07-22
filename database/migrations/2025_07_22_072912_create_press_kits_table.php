<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePressKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('press_kits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('new_and_media_category_id');
            $table->longText('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('download_pdf_file')->nullable();
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
        Schema::dropIfExists('press_kits');
    }
}

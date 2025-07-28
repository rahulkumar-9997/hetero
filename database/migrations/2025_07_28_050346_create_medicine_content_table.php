<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_content', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('medicine_category_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('medicine_category_id')->references('id')->on('medicine_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_content');
    }
}

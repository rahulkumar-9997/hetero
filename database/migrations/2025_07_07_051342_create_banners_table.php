<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('banner_heading_name')->nullable();
            $table->longText('banner_content')->nullable();
            $table->longText('banner_other_content')->nullable();
            $table->string('banner_link')->nullable();
            $table->string('banner_desktop_img')->nullable();
            $table->string('banner_mobile_img')->nullable();
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
        Schema::dropIfExists('banners');
    }
}

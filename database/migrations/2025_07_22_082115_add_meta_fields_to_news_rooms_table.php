<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaFieldsToNewsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_rooms', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('post_date');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_rooms', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
    }
}

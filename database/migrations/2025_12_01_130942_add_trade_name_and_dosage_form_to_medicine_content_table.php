<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTradeNameAndDosageFormToMedicineContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_content', function (Blueprint $table) {
            $table->string('title')->comment('МНН')->change();
            $table->string('trade_name')->nullable()->after('title')->comment('(ТН) Trade Name (or Brand Name)');
            $table->string('dosage_form')->nullable()->after('trade_name')->comment('(Форма выпуска) Dosage Form / Form of Release');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_content', function (Blueprint $table) {
            //
        });
    }
}

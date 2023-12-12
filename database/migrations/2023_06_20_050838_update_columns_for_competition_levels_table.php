<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competition_level', function (Blueprint $table) {
            $table->json('name')->nullable();
            $table->integer('competitors_count')->nullable()->change();
            $table->enum('save_amount', ['the_hole_quran', 'guz', 'surah', 'ayah'])->default('the_hole_quran');
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->enum('other_controls', ['tagweed_provisions', 'good_reading', 'other', 'ayah'])->default('tagweed_provisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_levels', function (Blueprint $table) {
            $table->integer('competitors_count')->change();
            $table->dropColumn(['name', 'save_amount', 'other_controls']);
        });
    }
};

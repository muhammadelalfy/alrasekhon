<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::whenTableHasColumn('competition_level','other_controls', function (Blueprint $table) {
            // Update the new JSON column with the values from the temporary column
            $table->dropColumn('other_controls');
        });
        Schema::table('competition_level', function (Blueprint $table) {
            // Update the new JSON column with the values from the temporary column
            $table->json('other_controls')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::whenTableHasColumn('competition_level','other_controls', function (Blueprint $table) {
            $table->dropColumn('other_controls');
//            DB::statement('ALTER TABLE competition_level MODIFY other_controls ENUM("tagweed_provisions","good_reading","other")');
        });
        Schema::table('competition_level', function (Blueprint $table) {
            // Update the new JSON column with the values from the temporary column
            $table->enum('other_controls',['other','good_reading','tagweed_provisions']);
        });
    }
};

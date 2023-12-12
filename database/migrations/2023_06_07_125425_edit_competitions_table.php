<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('competitions',function (Blueprint $table){
            $table->dropColumn('type');
            $table->dropColumn('age_from');
            $table->dropColumn('age_to');

            $table->foreignIdFor(\App\Models\CompetitionType::class)->constrained('competition_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions',function (Blueprint $table){
            $table->tinyInteger('type');
            $table->integer('age_from');
            $table->integer('age_to');

            $table->dropForeign(['competition_type_id']);
        });
    }
};

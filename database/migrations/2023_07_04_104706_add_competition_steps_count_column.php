<?php

use App\Enums\CompetitionAnnounceEnum;
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
        Schema::table('competitions', function (Blueprint $table){
            $table->json('steps_numbers')->nullable();
            $table->tinyInteger('is_announced')->default(CompetitionAnnounceEnum::UnAnnounced->value);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions', function (Blueprint $table){
            $table->dropColumn('steps_numbers');
        });
    }
};

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
        Schema::create('arbitration_committee_competition_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arbitration_committee_id')->index('acid');
            $table->unsignedBigInteger('competition_level_id')->index('clid');

            $table->foreign('arbitration_committee_id', 'fk_acid')->references('id')->on('arbitration_committees')->cascadeOnDelete();
            $table->foreign('competition_level_id', 'fk_clid')->references('id')->on('competition_level')->cascadeOnDelete();
            $table->engine = 'InnoDB';

        });

        Schema::table('competition_level', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arbitration_committee_level');
    }
};

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
        Schema::create('arbitration_committee_stage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arbitration_committee_id')->index();
            $table->unsignedBigInteger('stage_id')->index();

            $table->foreign('arbitration_committee_id')->references('id')->on('arbitration_committees')->cascadeOnDelete();
            $table->foreign('stage_id')->references('id')->on('stages')->cascadeOnDelete();

            $table->engine = 'InnoDB';

        });

        Schema::table('stages', function (Blueprint $table) {
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
        Schema::dropIfExists('arbitration_committee_stage');
    }
};

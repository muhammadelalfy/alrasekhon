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
        Schema::create('competition_standard_conditions', function (Blueprint $table) {
            $table->id();
            $table->longText('standard_condition_description');
            $table->unsignedBigInteger('competition_id')->index();

            $table->foreign('competition_id')->references('id')->on('competitions')->cascadeOnDelete();
            $table->engine = 'InnoDB';

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
        Schema::dropIfExists('competition_standard_conditions');
    }
};

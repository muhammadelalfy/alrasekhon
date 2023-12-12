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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->datetime('sign_up_start_date');
            $table->datetime('sign_up_end_date');
            $table->integer('age_from');
            $table->integer('age_to');
            $table->integer('competitors_max_num');
            $table->integer('competition_budget');
            $table->text('conditions');
            $table->string('competition_address');
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
        Schema::dropIfExists('competitions');
    }
};

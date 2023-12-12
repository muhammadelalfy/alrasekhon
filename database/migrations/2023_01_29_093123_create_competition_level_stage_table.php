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
        Schema::create('competition_level_stage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_level_id')->constrained('competition_level');
            $table->foreignId('stage_id')->constrained('stages');
            $table->foreignId('committee_id')->constrained('committees');
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
        Schema::dropIfExists('competition_level_stages');
    }
};

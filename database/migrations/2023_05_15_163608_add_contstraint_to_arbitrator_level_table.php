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
        Schema::table('arbitrator_level', function (Blueprint $table) {
            $table->foreign('arbitrator_id')->references('id')->on('arbitrators');
            $table->foreign('arbitrator_level_id')->references('id')->on('arbitrator_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arbitrator_level', function (Blueprint $table) {
            Schema::dropIfExists('arbitrator_level');
        });
    }
};

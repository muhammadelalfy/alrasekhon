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
        Schema::create('arbitration_committees', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->unsignedBigInteger('competition_id')->index();
            $table->unsignedBigInteger('committee_chairman_id')->index();
            $table->unsignedBigInteger('vice_committee_chairman_id')->index();
            $table->smallInteger('arbitrators_number');

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
        Schema::dropIfExists('arbitration_committees');
    }
};

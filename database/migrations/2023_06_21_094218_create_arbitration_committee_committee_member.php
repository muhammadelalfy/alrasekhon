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
        Schema::create('arbitration_committee_committee_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arbitration_committee_id')->index('arb_comm_id');
            $table->unsignedBigInteger('committee_member_id')->index('comm_mem_id');

            $table->foreign('arbitration_committee_id', 'fk_arb_comm_id')->references('id')->on('arbitration_committees')->cascadeOnDelete();
            $table->foreign('committee_member_id', 'fk_comm_mem_id')->references('id')->on('committee_members')->cascadeOnDelete();

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
        Schema::dropIfExists('arbitration_committee_member');
    }
};

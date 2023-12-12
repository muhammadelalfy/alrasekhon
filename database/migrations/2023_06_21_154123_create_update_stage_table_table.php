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
        Schema::table('stages', function (Blueprint $table) {
            $table->string('name')->change();
            $table->unsignedBigInteger('competition_id')->after('name')->index();

            $table->foreign('competition_id')->references('id')->on('competitions')->cascadeOnDelete();
            $table->engine = 'InnoDB';

            $table->dropColumn('description');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->json('name')->change();
        });
    }
};

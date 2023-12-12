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
        Schema::table('competition_level', function (Blueprint $table) {
            $table->integer('from')->nullable()->change();
            $table->integer('to')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_level', function (Blueprint $table) {
            $table->json('from')->nullable()->change();
            $table->json('to')->nullable()->change();
        });
    }
};

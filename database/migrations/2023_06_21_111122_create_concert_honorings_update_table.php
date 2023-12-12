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
        Schema::table('concert_honorings', function (Blueprint $table) {
            $table->renameColumn('address','location')->change();
            $table->string('competition_place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concert_honorings', function (Blueprint $table) {
            $table->renameColumn('location','address')->change();
            $table->dropColumn('competition_place');
        });
    }
};

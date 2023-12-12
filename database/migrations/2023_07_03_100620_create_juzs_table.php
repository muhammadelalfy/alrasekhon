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
        Schema::create('juzs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->integer('from_page');
            $table->integer('to_page');
            $table->integer('from_aya');
            $table->integer('to_aya');
            $table->string('from_sura', 191);
            $table->string('to_sura', 191);
            $table->integer('from_juz');
            $table->integer('alpha_num');
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
        Schema::dropIfExists('juzs');
    }
};

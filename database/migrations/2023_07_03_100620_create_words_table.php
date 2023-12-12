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
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text')->nullable();
            $table->text('simple')->nullable();
            $table->unsignedTinyInteger('sura')->nullable();
            $table->unsignedSmallInteger('aya')->nullable();
            $table->unsignedSmallInteger('quran_aya')->nullable();
            $table->unsignedSmallInteger('page')->nullable();
            $table->unsignedTinyInteger('line')->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->unsignedTinyInteger('juz')->nullable();
            $table->unsignedTinyInteger('hizb')->nullable();
            $table->unsignedTinyInteger('rub')->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->text('unicode')->nullable();
            $table->text('web_code')->nullable();
            $table->text('web_code_v3')->nullable();
            $table->text('mobile_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
};

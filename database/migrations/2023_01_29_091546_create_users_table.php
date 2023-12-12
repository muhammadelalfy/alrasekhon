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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('alternative_address')->nullable();
            $table->string('main_job')->nullable();
            $table->string('degree')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('attendance_status')->nullable(); //todo
            $table->tinyInteger('lang')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->json('identity')->nullable(); //todo
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

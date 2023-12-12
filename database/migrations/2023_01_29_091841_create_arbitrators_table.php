<?php

use App\Enums\StatusEnum;
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
        Schema::create('arbitrators', function (Blueprint $table) {
            $table->id();

            // ######################### First step (Basic info) ############################
            $table->string('first_name', 200)->nullable();
            $table->string('second_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('identity_proof', ['national_id', 'passport'])->nullable();
            $table->string('national_id', 18)->nullable();
            $table->string('passport', 15)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('nationality', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('phone', 15)->nullable();
            $table->tinyInteger('status')->default(StatusEnum::Active->value);

            // ######################### Second step (Scientific and practical experiences) ############################
            $table->string('qualification', 200)->nullable();
            $table->string('job', 200)->nullable();
            $table->boolean('is_teacher')->default(0)->nullable();
            $table->json('work_experiences')->nullable()->comment('Required if is_teacher = 1');
            $table->json('practical_experiences')->nullable();

            // ######################### Third step (Readings and vacations) ############################
//            $table->json('methods')->nullable();
//            $table->json('readings')->nullable();
//            $table->json('novels')->nullable();
            $table->json('authorizations')->nullable();

            // ######################### Third step (Readings and vacations) ############################
            $table->string('main_address')->nullable();
            $table->string('additional_address')->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('governorate_id')->index()->nullable();
            $table->unsignedBigInteger('city_id')->index()->nullable();
            $table->string('password');

            $table->engine = 'InnoDB';

            $table->softDeletes();
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
        Schema::dropIfExists('arbitrators');
    }
};

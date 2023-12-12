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
        Schema::create('contestants', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 200);
            $table->string('second_name', 200);
            $table->string('last_name', 200);
            $table->date('birth_date');
            $table->enum('identity_proof', ['national_id', 'passport']);
            $table->string('national_id', 18)->nullable();
            $table->string('passport', 15)->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('nationality', 200);
            $table->string('email', 200);
            $table->string('country_code', 5);
            $table->string('phone', 15);
            $table->tinyInteger('status')->default(StatusEnum::Active->value);
            $table->string('qualification', 200);
            $table->string('job', 200);
            $table->string('main_address')->nullable();
            $table->string('additional_address')->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('governorate_id')->index()->nullable();
            $table->unsignedBigInteger('city_id')->index()->nullable();
            $table->tinyInteger('step_no')->nullable();

            $table->string('password');

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
        Schema::dropIfExists('contestants');
    }
};

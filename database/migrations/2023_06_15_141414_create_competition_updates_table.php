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
        Schema::table('competitions', function (Blueprint $table) {

            $table->tinyInteger('status')->default(StatusEnum::Active->value)->after('competition_budget');
            $table->json('age_group')->after('competition_budget')->nullable();
            $table->json('age_from')->after('competition_budget')->nullable();
            $table->json('age_to')->after('competition_budget')->nullable();

            $table->json('competition_date')->after('competition_budget')->nullable();
            $table->json('registration_date')->after('competition_date')->nullable();

            $table->text('conditions')->nullable()->change();
            $table->string('competition_address')->nullable()->change();
            $table->string('location')->after('competition_address')->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('governorate_id')->index()->nullable();
            $table->unsignedBigInteger('city_id')->index()->nullable()->change();
            $table->unsignedBigInteger('sample_id')->nullable()->change();
            $table->unsignedBigInteger('concert_honoring_id')->nullable()->change();

            Schema::dropColumns('competitions', [
                'start_date',
                'end_date',
                'sign_up_start_date',
                'sign_up_end_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('competitions', function (Blueprint $table) {
            $table->integer('age_from')->change();
            $table->integer('age_to')->change();
            $table->text('conditions')->nullable()->change();
            $table->string('competition_address')->nullable()->change();

            $table->dropForeign('competitions_city_id_foreign');
            $table->dropForeign('competitions_concert_honoring_id_foreign');
            $table->dropForeign('competitions_sample_id_foreign');

            $table->dropColumn('city_id');
            $table->dropColumn('concert_honoring_id');
            $table->dropColumn('sample_id');

//            $table->unsignedBigInteger('city_id')->nullable()->after('governorate_id')->change();
//            $table->unsignedBigInteger('sample_id')->nullable()->change();
//            $table->unsignedBigInteger('concert_honoring_id')->nullable()->change();
        });

    }
};

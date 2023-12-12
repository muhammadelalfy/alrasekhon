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
        Schema::table('prizes', function (Blueprint $table) {
            $table->unsignedBigInteger('competition_id')->after('id')->index()->change();
//            $table->unsignedBigInteger('level_id')->after('competition_id')->nullable()->index()->change();
//            $table->unsignedBigInteger('user_id')->after('level_id')->nullable()->index()->change();
            $table->json('prize_data')->after('competition_id');
//            $table->json('competition_levels_names')->after('user_id');
//            $table->json('winners_rankings')->after('competition_levels_names');
//            $table->json('financials_awards_values')->after('winners_rankings');
//            $table->json('certificates_and_honors')->after('financials_awards_values');

            $table->dropForeign('prizes_level_id_foreign');
            $table->dropForeign('prizes_user_id_foreign');
            $table->dropColumn(['order', 'prize_value', 'certificate_name', 'level_id', 'user_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prizes', function (Blueprint $table){

            $table->unsignedBigInteger('competition_id')->change();
        });
    }
};

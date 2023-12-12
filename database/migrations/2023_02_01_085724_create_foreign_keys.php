<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
        Schema::table('governorates', function(Blueprint $table) {
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
                });
//        Schema::table('competition_level_stage', function(Blueprint $table) {
//            $table->foreignId('competition_level_id')->constrained('competition_level');
//                });
//
//        Schema::table('competition_level_stage', function(Blueprint $table) {
//            $table->foreignId('stage_id')->constrained('stages');
//                });
//
//        Schema::table('competition_level_stage', function(Blueprint $table) {
//            $table->foreignId('committee_id')->constrained('committees');
//                });
//
        Schema::table('competition_level', function(Blueprint $table) {
            $table->foreignId('competition_id')->constrained('competitions')->cascadeOnDelete();
                });

        Schema::table('competition_level', function(Blueprint $table) {
            $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
                });

        Schema::table('cities', function(Blueprint $table) {
            $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnDelete();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();

        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreignId('city_id')->nullable()->constrained();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreignId('level_id')->nullable()->constrained('levels');
        });

        Schema::table('committees', function(Blueprint $table) {
            $table->foreignId('city_id')->constrained('cities');
        });

        Schema::table('arbitrators', function(Blueprint $table) {
            $table->foreignId('user_id')->after('city_id')->constrained('users');
        });

        Schema::table('samples', function(Blueprint $table) {
//            $table->foreignId('arbitration_type_id')->constrained('arbitration_types');
        });


        Schema::table('concert_honorings', function(Blueprint $table) {
            $table->foreignId('city_id')->constrained('cities');
        });

        Schema::table('concert_honorings', function(Blueprint $table) {

            $table->foreignId('competition_id')->constrained('competitions');
        });

        Schema::table('competitions', function(Blueprint $table) {

            $table->foreignId('city_id')->constrained('cities');

        });

        Schema::table('competitions', function(Blueprint $table) {

            $table->foreignId('sample_id')->constrained('samples');
        });

        Schema::table('competitions', function(Blueprint $table) {

            $table->foreignId('concert_honoring_id')->constrained('concert_honorings');
        });

        Schema::table('advertisements', function(Blueprint $table) {
            $table->foreignId('competition_id')->constrained('competitions')->cascadeOnDelete();
        });

        Schema::table('questions', function(Blueprint $table) {
            $table->foreignId('sample_id')->constrained('samples');
        });

//        Schema::table('readings', function(Blueprint $table) {
//            $table->foreignId('way_id')->constrained('ways')->cascadeOnDelete();
//        });

//        Schema::table('readings', function(Blueprint $table) {
//            $table->foreignId('reading_id')->constrained('readings')->cascadeOnDelete();
//        });

        Schema::table('competition_types', function(Blueprint $table) {
//            $table->foreignId('competition_id')->constrained('competitions');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->foreignId('competition_id')->constrained('competitions');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->foreignId('level_id')->constrained('levels');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
        });

    }


	public function down()
	{

        Schema::table('competition_level', function(Blueprint $table) {
			$table->dropForeign('competition_id_foreign');
		});

        Schema::table('competition_level', function(Blueprint $table) {
			$table->dropForeign('level_id_foreign');
		});

        Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_governorate_id_foreign');
			$table->dropForeign('cities_country_id_foreign');
		});

        Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_city_id_foreign');
		});


        Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_level_id_foreign');
		});

        Schema::table('committees', function(Blueprint $table) {
            $table->dropForeign('committees_city_id_foreign');
        });

        Schema::table('arbitrators', function(Blueprint $table) {
            $table->dropForeign('arbitrators_user_id_foreign');
        });

        Schema::table('samples', function(Blueprint $table) {
//            $table->dropForeign('samples_arbitration_type_id_foreign');
        });



        Schema::table('concert_honorings', function(Blueprint $table) {
            $table->dropForeign('concert_honorings_city_id_foreign');
        });

        Schema::table('concert_honorings', function(Blueprint $table) {
            $table->dropForeign('concert_honorings_competition_id_foreign');
        });

        Schema::table('competitions', function(Blueprint $table) {
            $table->dropForeign('competitions_sample_id_foreign');

        });

        Schema::table('competitions', function(Blueprint $table) {
            $table->dropForeign('competitions_city_id_foreign');
        });

        Schema::table('competitions', function(Blueprint $table) {
            $table->dropForeign('competitions_concert_honorings_id_foreign');
        });

        Schema::table('advertisements', function(Blueprint $table) {
            $table->dropForeign('advertisements_competition_id_foreign');
        });

        Schema::table('winners', function(Blueprint $table) {
            $table->dropForeign('winners_user_id_foreign');
        });

        Schema::table('winners', function(Blueprint $table) {
            $table->dropForeign('winners_competition_id_foreign');
        });

        Schema::table('questions', function(Blueprint $table) {
            $table->dropForeign('questions_sample_id_foreign');
        });

        Schema::table('readings', function(Blueprint $table) {
            $table->dropForeign('readings_way_id_foreign');
        });

        Schema::table('recitations', function(Blueprint $table) {
            $table->dropForeign('recitations_reading_id_foreign');
        });

        Schema::table('competition_types', function(Blueprint $table) {
            $table->dropForeign('competition_types_competition_id_foreign');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->dropForeign('prizes_competition_id_foreign');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->dropForeign('prizes_level_id_foreign');
        });

        Schema::table('prizes', function(Blueprint $table) {
            $table->dropForeign('prizes_user_id_foreign');
        });

    }
}

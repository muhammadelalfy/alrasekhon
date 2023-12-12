<?php

use App\Enums\AdvertisementEnum;
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
        Schema::table('advertisements', function (Blueprint $table) {
            $table->string('name')->change();
            $table->longText('description')->nullable()->change();
            $table->string('media_type', 5);
            $table->string('url')->nullable()->change();

            $table->dropForeign('advertisements_competition_id_foreign');
            $table->dropColumn('competition_id');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->json('name')->change();
            $table->string('description')->nullable()->change();
            $table->string('url')->change();
        });

    }
};

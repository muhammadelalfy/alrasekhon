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
        DB::statement("ALTER TABLE users MODIFY COLUMN gender ENUM('male','female')");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN gender TINYINT");
    }
};

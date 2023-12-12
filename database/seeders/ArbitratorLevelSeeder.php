<?php

namespace Database\Seeders;

use App\Models\ArbitratorLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArbitratorLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArbitratorLevel::factory()->count(7)->create();
    }
}

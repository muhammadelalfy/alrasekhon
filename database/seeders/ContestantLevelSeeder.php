<?php

namespace Database\Seeders;

use App\Models\ContestantLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestantLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContestantLevel::factory()->count(7)->create();
    }
}

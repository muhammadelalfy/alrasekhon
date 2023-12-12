<?php

namespace Database\Seeders;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        Level::factory()->count(10)->create();
    }

}

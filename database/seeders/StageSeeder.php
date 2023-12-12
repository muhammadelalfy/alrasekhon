<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (Competition::pluck('id')->toArray() as $competitionId) {
            Stage::factory(['competition_id' => $competitionId])->count(7)->create();
        }
    }
}

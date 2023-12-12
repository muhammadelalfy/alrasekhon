<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\CompetitionStandardCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Amp\Parallel\Worker\factory;

class CompetitionStandardConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Competition::pluck('id')->toArray() as $competitionId) {
            CompetitionStandardCondition::factory(['competition_id' => $competitionId])->create();
        }
    }
}

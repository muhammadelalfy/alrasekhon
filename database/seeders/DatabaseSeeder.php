<?php

namespace Database\Seeders;

use App\Models\CommitteeChairman;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        $this->call([
            PermissionsTableSeeder::class,
            UsersTableSeeder::class,
            CompetitionTypeSeeder::class,
            ContestantLevelSeeder::class,
            ArbitratorLevelSeeder::class,
            SampleSeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            MethodSeeder::class,
            ReadingSeeder::class,
            CompetitionSeeder::class,
            LevelSeeder::class,
            CompetitionLevelSeeder::class,
            StageSeeder::class,
            CommitteeMemberSeeder::class,
            CommitteeChairmanSeeder::class,
            ViceCommitteeChairmanSeeder::class,
            SurasTableSeeder::class,
            JuzsTableSeeder::class,
//            WordsTableSeeder::class,
            CompetitionStandardConditionSeeder::class,
            AdvertisementSeeder::class,
        ]);
    }
}

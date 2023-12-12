<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\CompetitionLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionLevelSeeder extends Seeder
{
    public function run()
    {


        CompetitionLevel::factory()->count(7)->create();

//        DB::table('competition_level')->insert([
//            [
//                'name' => json_encode(['level'.random_int(1,5)]),
//                'competitors_count' => random_int(1,5),
//                'save_amount' => 'the_hole_quran',
//                'from' => null,
//                'to' => null,
//                'other_controls' => 'tagweed_provisions',
//                'competition_id' => random_int(1,4),
//                'level_id'=>random_int(1,4),
//                'winners_count' => random_int(1,5)
//            ],
//            // Add more data as needed
//        ]);

    }
}

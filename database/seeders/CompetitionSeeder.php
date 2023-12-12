<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competitions = Competition::factory()->count(7)->create();

        foreach ($competitions as $competition) {
            File::factory([
                'type' => 'competition_photo',
                'fileable_type' => 'Competition',
                'fileable_id' => $competition->id,
            ])->create();
            $competition->update([
                'country_id' => $competition->city->country->id,
                'governorate_id' => $competition->city->governorate->id
            ]);
        }


    }
}

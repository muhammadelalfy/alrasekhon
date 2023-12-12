<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory([
            'name' => [
                'ar' => 'مدينة القاهرة',
                'en' => 'Cairo city',
            ],
            'country_id' => 1,
            'governorate_id' => 1
        ])->create();
        City::factory([
            'name' => [
                'ar' => ' مدينة الأسكندرية',
                'en' => 'Alexandria city',
            ],
            'country_id' => 1,
            'governorate_id' => 2
        ])->create();

        City::factory([
            'name' => [
                'ar' => 'مدينة مكة',
                'en' => 'Mecca city',
            ],
            'country_id' => 2,
            'governorate_id' => 3
        ])->create();

        City::factory([
            'name' => [
                'ar' => 'مدينة الرياض',
                'en' => 'Riyadh city',
            ],
            'country_id' => 2,
            'governorate_id' => 4
        ])->create();

        City::factory([
            'name' => [
                'ar' => 'مدينة الكويت',
                'en' => 'Kuwait city',
            ],
            'country_id' => 3,
            'governorate_id' => 5
        ])->create();

        City::factory([
            'name' => [
                'ar' => 'مدينة الجهراء',
                'en' => 'Jahra city',
            ],
            'country_id' => 3,
            'governorate_id' => 6
        ])->create();
    }
}

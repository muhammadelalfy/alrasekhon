<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory([
            'name' => [
                'ar' => 'مصر',
                'en' => 'Egypt',
            ]
        ])->create();

        Country::factory([
            'name' => [
                'ar' => 'السعودية',
                'en' => 'Saudi',
            ]
        ])->create();

        Country::factory([
            'name' => [
                'ar' => 'الكويت',
                'en' => 'Kuwait',
            ]
        ])->create();
    }
}

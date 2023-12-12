<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorate::factory([
            'name' => [
                'ar' => 'محافظة القاهرة',
                'en' => 'Cairo gov',
            ],
            'country_id' => 1
        ])->create();

        Governorate::factory([
            'name' => [
                'ar' => 'محافظة الأسكندرية',
                'en' => 'Alexandria gov',
            ],
            'country_id' => 1
        ])->create();

        Governorate::factory([
            'name' => [
                'ar' => 'منطقة مكة',
                'en' => 'Mecca area',
            ],
            'country_id' => 2
        ])->create();

        Governorate::factory([
            'name' => [
                'ar' => 'منطقة الرياض',
                'en' => 'Riyadh area',
            ],
            'country_id' => 2
        ])->create();

        Governorate::factory([
            'name' => [
                'ar' => 'منطقة الكويت',
                'en' => 'Kuwait area',
            ],
            'country_id' => 3
        ])->create();

        Governorate::factory([
            'name' => [
                'ar' => 'منطقة الجهراء',
                'en' => 'Jahra area',
            ],
            'country_id' => 3
        ])->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nameAr = [
            'الشاطبية',
            'الدرة',
            'الطيبة',
        ];
        $nameEn = [
            'Al-Shatibiyah',
            'Al-Dorra',
            'Al-Tayba',
        ];

        foreach ($nameAr as $key => $name) {
            Method::factory(['name' => ['ar' => $name, 'en' => $nameEn[$key]]])->create();
        }
    }
}

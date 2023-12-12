<?php

namespace Database\Seeders;

use App\Models\Reading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shatibiyahAr = [
            'قالون نافع المدني',
            'ورش نافع المدني',
            'البزي عن عبد الله بن كثير المكي',
            'قنبل عن عبد الله بن كثير المكي',
            'الدوري عن أبي عمرو البصري',
            'السوسي عن ابو عمرو البصري',
            'هشام عن ابن عامر الشامي',
            'ابن ذكوان عن ابن عامر الشامي',
            'شعبة عن عاصم بن ابي النجود الكوفي',
            'حفص عن عاصم بن أبي النجود الكوفي',
            'خلف عن حمزة الزيات الكوفي',
            'خلاد عن حمزة الزيات الكوفي',
            'أبو الحارث عن الكسائي الكوفي',
            'الدوري عن الكسائي الكوفي',
        ];
        $shatibiyahEn = [
            'Qaloun Nafie Al-Madani',
            'Warsh Nafie Al-Madani',
            'Al-Bazi on the authority of Abdullah bin Katheer Al-Makki',
            'Qonbol the authority of Abdullah bin Kathir al-Makki',
            'Al-Douri on the authority of Abu Amr Al-Basri',
            'Al-Susi on the authority of Abu Amr Al-Basri',
            'Hisham on the authority of Ibn Amer al-Shami',
            'Ibn Dhakwan, on the authority of Ibn Amer al-Shami',
            'Shu\'ba on the authority of Asim bin Abi Al-Nujood Al-Kufi',
            'Hafs on the authority of Asim bin Abi Al-Nujood Al-Kufi',
            'Khalaf on the authority of Hamza Al-Zayyat Al-Kufi',
            'Khllad on the authority of Hamza Al-Zayyat Al-Kufi',
            'Abu al-Harith on the Kofi',
            'Al-Douri for Al-Kafi Al-Kafi',
        ];

        $dorraAr = [
            'ابن وردان عن أبي جعفر المدني',
            'ابن جماز عن أبي جعفر المدني',
            'رويس عن يعقوب الحضرمي',
            'روح عن يعقوب الحضرمي',
            'اسحق عن خلف البزار عن حمزة الكوفي',
            'إدريس عن خلف البزار عن حمزة الكوفي',
        ];
        $dorraEn = [
            'Ibn Wardan on the authority of Abu Jaafar al-Madani',
            'Ibn Jumaz on the authority of Abu Jaafar al-Madani',
            'Royce on the authority of Yaqoub Al-Hadrami',
            'Roh on the authority of Ya`qub al-Hadrami',
            'Isaac on the authority of al-Bazzar on the authority of Hamza al-Kufi',
            'Idris, on the authority of Khalaf al-Bazzar, on the authority of Hamza al-Kufi',
        ];

        $taybaAr = array_merge($shatibiyahAr, $dorraAr); // it's equal $shatibiyahAr + $dorraAr
        $taybaEn = array_merge($shatibiyahEn, $dorraEn); // it's equal $shatibiyahEn + $dorraEn

        foreach ($shatibiyahAr as $key => $name) {
            $reading = Reading::factory([
//                'method_id' => 1,
                'name' => [
                    'ar' => $name,
                    'en' => $shatibiyahEn[$key],
                ]
            ])->create();

            DB::table('method_reading')->insert([
                ['reading_id' => $reading->id, 'method_id' => 1], // Al-Shatibiyah
                ['reading_id' => $reading->id, 'method_id' => 3], // Al-Tayba
            ]);
        }

        foreach ($dorraAr as $key => $name) {
            $reading = Reading::factory([
//                'method_id' => 2,
                'name' => [
                    'ar' => $name,
                    'en' => $dorraEn[$key],
                ]
            ])->create();

            DB::table('method_reading')->insert([
                ['reading_id' => $reading->id, 'method_id' => 2], // Al-Dorra
                ['reading_id' => $reading->id, 'method_id' => 3], // Al-Tayba
            ]);
        }

//        foreach ($taybaAr as $key => $name) {
//            Reading::factory([
//                'method_id' => 3,
//                'name' => [
//                    'ar' => $name,
//                    'en' => $taybaEn[$key],
//                ]
//            ])->create();
//        }




    }
}

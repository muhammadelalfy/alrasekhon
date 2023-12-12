<?php

namespace Database\Seeders;

use App\Enums\AdvertisementEnum;
use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::factory([ 'media_type' => AdvertisementEnum::Link, 'url' => 'https://www.youtube.com/embed/tgbNymZ7vqY'])->count(7)->create();
        Advertisement::factory([ 'media_type' => AdvertisementEnum::Video])->count(7)->create();
        Advertisement::factory([ 'media_type' => AdvertisementEnum::Image])->count(7)->create();
//        Advertisement::factory([ 'media_type' => AdvertisementEnum::Video, 'url' => 'https://media.w3.org/2010/05/sintel/trailer.mp4'])->count(7)->create();
//        Advertisement::factory([ 'media_type' => AdvertisementEnum::Image, 'url' => 'http://rasekhon.local/UI/assets/images/authBg.png'])->count(7)->create();
    }
}

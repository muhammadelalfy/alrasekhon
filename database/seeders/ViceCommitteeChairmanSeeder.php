<?php

namespace Database\Seeders;

use App\Models\ViceCommitteeChairman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViceCommitteeChairmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ViceCommitteeChairman::factory()->count(7)->create();
    }
}

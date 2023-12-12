<?php

namespace Database\Seeders;

use App\Models\CommitteeChairman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeChairmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommitteeChairman::factory()->count(7)->create();
    }
}

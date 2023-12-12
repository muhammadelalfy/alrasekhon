<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the default permissions
        $defaultPermissions = Permission::defaultPermissions();

        Schema::disableForeignKeyConstraints();

        DB::table('permissions')->truncate();

        foreach ($defaultPermissions as $perm) {
            Permission::firstOrCreate($perm);
        }

        Schema::enableForeignKeyConstraints();

        $this->command->info('Default permissions added.');
        $this->command->line('------------------------------------------------------------------------------');
    }
}

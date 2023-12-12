<?php

namespace Database\Seeders;

use App\Constants\UserTypesEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = Permission::where('guard_name', 'sanctum')->get();
        $role = Role::findOrCreate('admin', 'sanctum');
        $role->givePermissionTo($permissions);
        $user = User::where('email' , 'admin@admin.com')->first();
        if (!$user){
            $user = User::create([
                'first_name' => 'admin',
                'last_name' => 'admin',
//                'nationality' => 'egyptian',
                'email' => 'admin@admin.com',
                'phone' => 12345678910,
                'password' => "123123",
                'type' => UserTypesEnum::ADMIN->value
            ]);
        }
        $user->assignRole($role);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the RoleSeeder and UserSeeder
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        // Create a user with the Admin role
        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);

            $adminUser->roles()->attach($adminRole->id);
        }
    }
}

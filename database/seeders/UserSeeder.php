<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all roles from the roles table
        $roles = Role::all();

        // Create 10 users using the UserFactory
        User::factory(10)->create()->each(function ($user) use ($roles) {
            // Assign a random role to the user
            if ($roles->isNotEmpty()) {
                $user->roles()->attach($roles->random()->id);
            }
        });
    }
}

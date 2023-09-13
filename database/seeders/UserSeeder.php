<?php

namespace Database\Seeders;

use App\Models\User;
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
        //Add specific Known Users and assign Roles
        User::factory()->create([
            'name' => 'Peter Pike',
            'email' => 'pikepeter@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('SuperAdmin');

        User::factory()->create([
            'name' => 'Client Admin',
            'email' => 'clientadmin@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('ClientAdmin');

        User::factory()->create([
            'name' => 'Competition Manager',
            'email' => 'compmanager@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('CompManager');

        User::factory()->create([
            'name' => 'Comp User 1',
            'email' => 'compuser1@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('CompUser');

        User::factory()->create([
            'name' => 'Comp User 2',
            'email' => 'compuser2@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('CompUser');
    }
}

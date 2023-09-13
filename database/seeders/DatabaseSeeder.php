<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Set up Roles and Permissions
        // $this->call([
        //     RolesAndPermissionSeeder::class,
        // ]);

        //Create clients and other Seeds
        $this->call([
            UserSeeder::class,
            ClientSeeder::class,
            CompetitionSeeder::class,
        ]);
    }
}

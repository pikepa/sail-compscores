<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Set up Roles and Permissions
        $this->call([
            RolesAndPermissionSeeder::class,
        ]);
        

        
        //Create organisation and other Seeds
        $this->call([
            UserSeeder::class,
            OrganisationSeeder::class
        ]);
    }
}

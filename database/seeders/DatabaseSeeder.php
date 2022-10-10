<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Peter Pike',
            'email' => 'pikepeter@gmail.com',
            'password'=> bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Amy Lee',
            'email' => 'amylee@gmail.com',
            'password'=> bcrypt('password')
        ]);
        
        Role::create([
            'name' => 'SuperAdmin',
        ]);

        Role::create([
            'name' => 'ClientOwner',
        ]);
    }
}

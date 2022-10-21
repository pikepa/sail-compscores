<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->insert([
            'name' => 'Urban Energy Southport',
            'contact_name' => 'Kelly Williams',
            'contact_email' => 'kellywilliams@gmail.com',
            'contact_phone' => '+60 11 2131 6106',
            'owner_id' => 2,
        ]);

        DB::table('organisations')->insert([
            'name' => 'Urban Energy Miami',
            'contact_name' => 'Fred Blogs',
            'contact_email' => 'fredblogs@gmail.com',
            'contact_phone' => '+61 498 020 843',
            'owner_id' => 2,
        ]);

        //Create Random Organisations
        Organisation::factory()->count(5)
        ->create();
    }
}
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
              'name' => fake()->company(),
              'contact_name' =>fake()->fullname(),
              'contact_email' =>fake()->safemail(),
              'contact_phone' =>fake()->phoneNumber(),
              'owner_id' => User::factory()->create(),
        ];
    }
}

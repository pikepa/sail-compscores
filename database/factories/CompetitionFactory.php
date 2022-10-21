<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comp_name' => fake()->lastName(),
            'comp_venu' => fake()->userName(),
            'comp_type' => fake()->country(),
            'client_id' => Client::factory()->create()->id,
            'start_date' => Carbon::now(),
        ];
    }
}

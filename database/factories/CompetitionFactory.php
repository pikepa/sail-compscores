<?php

namespace Database\Factories;

use App\Models\Organisation;
use Carbon\Carbon;
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
            'org_id' => Organisation::factory()->create()->id,
            'start_date' => Carbon::now(),
        ];
    }
}

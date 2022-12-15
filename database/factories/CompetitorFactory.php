<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName,
            'surname' => fake()->lastName,
            'team_name' => fake()->company,
        ];
    }
}

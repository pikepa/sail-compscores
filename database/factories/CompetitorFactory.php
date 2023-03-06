<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
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
            'gender' => Arr::random(['Male','Female']),
            'competitor_dob' => Carbon::today()->subYears(rand(20, 70))->format('Y-m-d'),
            'email' => fake()->safeEmail(),
            'team_name' => fake()->company,
            'is_team' => Arr::random(['0','1']),
        ];
    }
}

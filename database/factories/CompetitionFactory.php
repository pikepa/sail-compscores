<?php

namespace Database\Factories;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            'comp_venue' => fake()->userName(),
            'comp_type' => Arr::random(['Individual', 'Teams']),
            'client_id' => Client::factory()->create()->id,
            'start_date' => fake()->dateTimeBetween('-10 week', '-1 week'),
            'isPublic' => 0,
            'released_at' => Carbon::now(),
        ];
    }

    public function released(Carbon $date = null): self
    {
        return $this->state(
            fn ($attributes) => ['released_at' => $date ?? Carbon::now()]
        );
    }
}

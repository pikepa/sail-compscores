<?php

namespace Database\Factories;

use App\Models\Competitor;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitorEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory()->create()->id,
            'competitor_id' => Competitor::factory()->create()->id,
        ];
    }
}

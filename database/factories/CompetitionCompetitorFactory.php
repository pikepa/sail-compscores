<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\Competitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetitionCompetitor>
 */
class CompetitionCompetitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'competitor_id' => Competitor::factory()->create()->id,
            'competition_id' => Competition::factory()->create()->id,
            // 'entry_status' => 'UNPAID',
        ];
    }
}

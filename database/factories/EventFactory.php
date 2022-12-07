<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Competition;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $valueArray1=[
            'Max Reps',
            'For Time',
            'Max Wgt',
            'Comb Wgt',
        ];
        $valueArray2=[
            '',
            'In Progress',
            'Complete',
            'Finalised',
        ];
        $hr = substr('0'.random_int(7,12),0,2);
        $min = substr('0'.random_int(0,59),0,2);

        return [
            'seq_no' => fake()->randomNumber(4,true),
            'event_name' => fake()->ColorName(),
            'event_description' => fake()->sentence(10),
            'event_date' => Carbon::now(),
            'event_time' => $hr.':'.$min,
            'event_type' => Arr::random($valueArray1),
            'event_status' => Arr::random($valueArray2),
            'competition_id' => Competition::factory()->create()->id,
        ];
    }
}

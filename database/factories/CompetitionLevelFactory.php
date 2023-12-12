<?php

namespace Database\Factories;
use App\Models\Competition;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompetitionLevel;

class CompetitionLevelFactory extends Factory
{
    protected $model = CompetitionLevel::class;

    public function definition()
    {
        return [
            'name' => [
                'ar' => $this->faker->text(20),
                'en' => $this->faker->text(20),
            ],
            'competitors_count' => $this->faker->numberBetween(1, 5),
            'save_amount' => 'the_hole_quran',
            'from' => null,
            'to' => null,
            'other_controls' => 'tagweed_provisions',
            'competition_id' => $this->faker->randomElement(Competition::pluck('id')->toArray()),
            'level_id' => $this->faker->randomElement(Level::pluck('id')->toArray()),
            'winners_count' => $this->faker->numberBetween(1, 5),
];
    }
}

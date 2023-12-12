<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\CompetitionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
            'name' => $this->faker->name,
            'competitors_max_num' => $this->faker->randomFloat(0, 3, 7),
            'competition_budget' => $this->faker->randomFloat(0, 1000, 2000),
            'registration_date' => [Carbon::now(), Carbon::now()->addDays(2)],
            'competition_date' => [Carbon::now(), Carbon::now()->addDays(2)],
            'age_group' => [$this->faker->name, $this->faker->name],
            'age_from' => [$this->faker->randomNumber(2), $this->faker->randomNumber(2)],
            'age_to' => [$this->faker->randomNumber(2), $this->faker->randomNumber(2)],
            'competition_address' => $this->faker->address,
            'location' => $this->faker->address,
            'competition_type_id' => $this->faker->randomElement(CompetitionType::pluck('id')->toArray()),
            'city_id' => $this->faker->randomElement(City::pluck('id')->toArray()),
            'steps_numbers' => [1],
        ];
    }
}

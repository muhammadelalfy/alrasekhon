<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArbitratorLevel>
 */
class ArbitratorLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'ar' => $this->faker->text(20),
                'en' => $this->faker->text(20)
            ],
            'description' => [
                'ar' => $this->faker->text(20),
                'en' => $this->faker->text(20)
            ],
        ];
    }
}

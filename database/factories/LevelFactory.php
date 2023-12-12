<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Level;

class LevelFactory extends Factory
{
    protected $model = Level::class;

    public function definition()
    {
        return [
            'name' => json_encode(['Level ' . $this->faker->numberBetween(1, 10)]),
            'memorizing' => json_encode(['Surah ' . $this->faker->word]),
            'attributes' => json_encode([$this->faker->word]),
            'description' => null,
        ];
    }
}

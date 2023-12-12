<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
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
                'ar' => $this->faker->name,
                'en' => $this->faker->name,
            ],
            'ext' => 'jpg',
            'url' => 'storage/app/public/1687159537gmbe-chandan-verma-2sy5yb0szf4-unsplash.jpg',
            'user_id' => 1
        ];
    }
}

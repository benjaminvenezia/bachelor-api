<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gage>
 */
class GageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'is_done' => $this->faker->boolean,
            'date_string' => $this->faker->date('Y-m-d'),
            'day' => $this->faker->numberBetween(1, 31),
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->numberBetween(2022, 2023),
            'timestamp' => $this->faker->unixTime,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }
}

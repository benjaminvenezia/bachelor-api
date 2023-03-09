<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'group_id' => Group::all()->random()->id,
            'category' => 'kitchen',
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'reward' => 12,
            'isDone' => false,
            'associated_day' => 'Lun',
        ];
    }
}

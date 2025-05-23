<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
   public function definition(): array
{
    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph,
        'is_completed' => $this->faker->boolean(30), // 30% chance completed
        'user_id' => \App\Models\User::factory(), // default, will override in seeder
    ];
}

}

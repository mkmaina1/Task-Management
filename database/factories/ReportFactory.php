<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Report;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


return [
    'user_id' => User::inRandomOrder()->where('role', 'user')->first()?->id ?? User::factory(),
    'task_id' => Task::inRandomOrder()->first()?->id ?? Task::factory(),
    'content' => $this->faker->paragraph(3),
    'created_at' => now()->subDays(rand(0, 14)),
    'updated_at' => now(),
    'admin_reply'=>$this->faker->sentence(6),
];
    
    }
}

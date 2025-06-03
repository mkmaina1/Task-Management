<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Task;
use App\Models\User;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        // Ensure you have users and tasks first
        if (User::count() < 1 || Task::count() < 1) {
            $this->call([
            UserWithTasksSeeder::class,
                TaskSeeder::class,
            ]);
        }

        // Generate reports for each task by a random user
        $tasks = Task::all();

        foreach ($tasks as $task) {
            Report::factory()->count(rand(1, 3))->create([
                'task_id' => $task->id,
                'user_id' => User::where('role', 'user')->inRandomOrder()->first()?->id,
            ]);
        }
    }
}
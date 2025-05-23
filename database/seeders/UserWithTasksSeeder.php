<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserWithTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users each with 7 tasks
        User::factory()
            ->count(10)
            ->hasTasks(7)
            ->create();
    }
}
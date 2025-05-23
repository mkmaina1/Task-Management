<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Call the custom seeder that creates users with tasks
        $this->call(UserWithTasksSeeder::class);
    }
}



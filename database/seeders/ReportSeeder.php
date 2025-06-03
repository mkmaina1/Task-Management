<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\Report;
use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();
        $users=User::with('tasks')->get();

        foreach ($users as $user) {
            foreach($user->tasks as $task){
                Report::create([
                    'user_id'=>$user->id,
                    'task_id'=>$task->id,
                    'admin_reply'=>$faker->sentence(6,true),
                    'content'=>$faker->paragraph(3,true),
                    'status'=>$faker->randomElement(['pending','replied']),
                ]);
            }
        }
    }
}




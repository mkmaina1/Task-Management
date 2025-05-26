<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('is_completed', true)->count();
        $pendingTasks = Task::where('is_completed', false)->count();

        $users = User::withCount('tasks')->get();

        return view('admin.dashboard', compact(
            'totalTasks', 'completedTasks', 'pendingTasks', 'users'
        ));
    }
}


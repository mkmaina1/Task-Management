<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class AdminController extends Controller
{
    // Admin Dashboard Stats View
    public function dashboard()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('is_completed', true)->count();
        $pendingTasks = Task::where('is_completed', false)->count();
         $users = User::withCount('tasks')->paginate(10);

        return view('admin.dashboard', compact(
            'totalTasks', 'completedTasks', 'pendingTasks', 'users'
        ));
    }

    // Paginated Users List View
    public function users()
    {
        $users = User::withCount('tasks')->paginate(10); // Grouped in 10s
        return view('admin.index', compact('users'));
    }

// Show edit form

public function edit(User $user)
    {
    
        return view('admin.edit', compact('user'));
    }

// Update user
public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($request->only(['name', 'email', 'role']));

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}
   
}

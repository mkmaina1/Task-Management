<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard with task stats
Route::get('/dashboard', function () {
    $user = Auth::user();
    $tasks = $user->isAdmin() ? Task::all() : $user->tasks;
    return view('dashboard', [
        'taskCount' => $tasks->count(),
        'completedCount' => $tasks->where('is_completed', true)->count(),
        'pendingCount' => $tasks->where('is_completed', false)->count(),
    ]);
})->middleware(['auth'])->name('dashboard');

// ✅ Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Settings page
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::post('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');

    // Task management
    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{task}/complete', [TaskController::class, 'markAsComplete'])->name('tasks.complete');

});

// Admin-only routes with URL prefix and proper middleware
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('admin/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
});


// Auth scaffolding
require __DIR__.'/auth.php';

// Manual logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

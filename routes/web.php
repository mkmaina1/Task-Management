<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Http\Controllers\ReportController;


// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard with task stats
Route::get('/dashboard', function () {
    $user = Auth::user();
    $tasks = $user->isAdmin()|| $user->isSuperAdmin() ? Task::all() : $user->tasks;
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
    Route::get('admin/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::get('admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::get('admin/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
});


     // Add more Super Admin routes here
Route::prefix('superadmin')->middleware(['auth', 'is_super_admin'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    Route::get('/manage', [SuperAdminController::class, 'manage'])->name('super_admin.manage');

    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    Route::get('/users', [SuperAdminController::class, 'manageUsers'])->name('super_admin.users');
    Route::post('/users/{user}/promote', [SuperAdminController::class, 'promoteToAdmin'])->name('super_admin.promote');
    Route::post('/users/{user}/demote', [SuperAdminController::class, 'demoteToUser'])->name('super_admin.demote');
    Route::delete('/users/{user}', [SuperAdminController::class, 'deleteUser'])->name('super_admin.delete_user');
    Route::get('/reports', [SuperAdminController::class, 'viewReports'])->name('super_admin.reports');
    Route::post('/reports/{report}/reply', [SuperAdminController::class, 'replyToReport'])->name('super_admin.reports.reply');
});




    // User sends report about a task
Route::middleware('auth')->group(function () {
    Route::resource('/reports', ReportController::class)->only(['index', 'create', 'store']);
     Route::get('/reports/{task}', [ReportController::class, 'create'])->name('reports.create');


    Route::middleware('is_super_admin')->group(function () {
        Route::post('/super_admin/reports/{report}/reply', [ReportController::class, 'reply'])->name('super_admin.reports.reply');
    });
    Route::middleware('is_admin')->group(function () {
        Route::post('/admin/reports/{report}/reply', [ReportController::class, 'reply'])->name('admin.reports.reply');
    });
    
});



// Auth scaffolding
require __DIR__.'/auth.php';

// Manual logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

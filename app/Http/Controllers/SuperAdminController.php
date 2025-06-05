<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuperAdminController extends Controller
{
    // Dashboard overview
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalReports = Report::count();
        $totalTasks = Task::count();

        $recentUsers = User::latest()->take(5)->get(); // 🔥 Last 5 users/admins

        return view('super_admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalReports',
            'totalTasks',
            'recentUsers'
        ));
    }

    // Manage users
   public function manageUsers()
{
    $users = User::where('role', '!=', 'super_admin')->latest()->paginate(10);
    return view('super_admin.users.index', compact('users'));
}


    // Promote user to admin
    public function promoteToAdmin(User $user)
    {
        if ($user->role !== 'admin') {
            $user->role = 'admin';
            $user->save();
            return back()->with('success', $user->name . ' has been promoted to admin.');
        }
        return back()->with('info', $user->name . ' is already an admin.');
    }

    // Demote admin to user
    public function demoteToUser(User $user)
    {
        $user->update(['role' => 'user']);
        return back()->with('success', 'Admin demoted to User.');
    }

    // Delete user
    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    // View all reports
    public function viewReports()
    {
        $reports = Report::with('user', 'task')->latest()->get();
        return view('super_admin.reports.index', compact('reports'));
    }

    // Reply to report
    public function replyToReport(Request $request, Report $report)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $report->reply = $request->reply;
        $report->save();

        // Optional email notification
        Mail::raw("Reply to your report: " . $request->reply, function ($message) use ($report) {
            $message->to($report->user->email)
                    ->subject('Reply to your task report');
        });

        return back()->with('success', 'Reply sent successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuperAdminController extends Controller
{
    // Dashboard overview
    public function dashboard()
    {
       
            $userCount => User::count();
            $adminCount => User::where('role', 'admin')->count();
            $reportCount => Report::count();
             return view('super_admin.dashboard',compact ( 
                'usercount', 'admincount', 'reportcount'
             ));
        
    }

    // Manage users
    public function manageUsers()
    {
        $users = User::where('role', '!=', 'super_admin')->get();
        return view('super_admin.users', compact('users'));
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

        public function demoteToUser(User $user)
    {
            $user->update(['role' => 'user']);
         return back()->with('success', 'Admin demoted to User.');
    }

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

        // Notify user via email (optional)
        Mail::raw("Reply to your report: " . $request->reply, function ($message) use ($report) {
            $message->to($report->user->email)
                    ->subject('Reply to your task report');
        });

        return back()->with('success', 'Reply sent successfully.');
    }
}

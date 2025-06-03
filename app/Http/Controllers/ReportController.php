<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    
public function index()
{
    $user = Auth::user();

    $reports = ($user->isAdmin() || $user->isSuperAdmin())
        ? Report::with('user', 'task')->latest()->paginate(2)
        : $user->reports()->with('task')->latest()->paginate(2);

    return view('reports.index', compact('reports'));
}


public function create()
{
    $tasks = Auth::user()->tasks;
    return view('reports.create', compact('tasks'));
}

public function store(Request $request)
{
    $request->validate([
        'task_id' => 'nullable|exists:tasks,id',
        'content' => 'required|string|min:5'
    ]);

    Report::create([
        'user_id' => Auth::id(),
        'task_id' => $request->task_id,
        'content' => $request->content,
    ]);

    // Optional: notify admin

    return redirect()->route('reports.index')->with('success', 'Report submitted Successfully!.');
}

public function reply(Request $request, Report $report)
{
    // Allow only admins and super admins to reply
    if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'admin_reply' => 'required|string|min:2'
    ]);

    $report->update(['admin_reply' => $request->admin_reply]);

    // Optional: Send notification to user

    return redirect()->back()->with('success', 'Reply sent.');
}

}


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
    $reports = Auth::user()->isAdmin()
        ? Report::with('user', 'task')->latest()->get()
        : Auth::user()->reports()->with('task')->latest()->get();
       

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
    $request->validate([
        'admin_reply' => 'required|string|min:2'
    ]);

    $report->update(['admin_reply' => $request->admin_reply]);

    // Optional: notify user

    return redirect()->back()->with('success', 'Reply sent.');
}
}


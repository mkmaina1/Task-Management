@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Tasks</h2>

    <!-- Flash Messages -->
    @if (session('success'))
        <div id="flash-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="flash-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Button -->
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-4">+ New Task</a>

    <!-- Filters -->
    <form method="GET" action="{{ route('tasks.index') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">-- All --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ request('due_date') }}" class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Filter</button>
        </div>
    </form>

    <!-- Task Table -->
    @if($tasks->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    @php
                        $date = \Carbon\Carbon::parse($task->due_date)->format('M d, Y');
                    @endphp

                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date ? $date : 'No due date' }}</td>
                    <td>
                        @if ($task->is_completed)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-danger">Pending</span>
                        @endif
                    </td>
                   <td class="text-center">
    @if (auth()->id() === $task->user_id || auth()->user()->isAdmin())
        @if (!$task->is_completed)
            <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-success me-1">Complete</button>
            </form>
        @endif

        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning me-1">Edit</a>

        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    @else
        <span class="text-muted">No access</span>
    @endif
</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $tasks->onEachSide(1)->links('pagination::simple-bootstrap-5') }}
    </div>
    @else
        <p class="text-muted">No tasks found.</p>
    @endif
</div>

<!-- Auto Dismiss Flash -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }, 3000);
        }
    });
</script>
@endsection

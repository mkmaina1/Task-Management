@extends('layouts.app')

@section('title', 'View Task')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            
            {{-- Task Title & ID --}}
            <div class="mb-4">
                <h2 class="card-title h1 fw-bold text-dark">{{ $task->title }}</h2>
                <small class="text-muted">Task ID: #{{ $task->id }}</small>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-secondary">Description</h5>
                <p class="text-dark">{{ $task->description ?? 'No description provided.' }}</p>
            </div>

            {{-- Status and Due Date --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <h6 class="fw-semibold text-secondary">Status</h6>
                    @if($task->is_completed)
                        <span class="badge bg-success px-3 py-2 rounded-pill">Completed</span>
                    @else
                        <span class="badge bg-danger px-3 py-2 rounded-pill">Pending</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6 class="fw-semibold text-secondary">Due Date</h6>
                    <p class="text-dark">
                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('F j, Y') : 'No due date' }}
                    </p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex flex-wrap gap-3 border-top pt-4">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning text-white shadow-sm">
                    <i class="bi bi-pencil-square me-1"></i> Edit Task
                </a>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger shadow-sm">
                        <i class="bi bi-trash me-1"></i> Delete Task
                    </button>
                </form>

                <a href="{{ route('tasks.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Tasks
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

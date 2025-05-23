@extends('layouts.app')

@section('title', 'View Task')

@section('content')
<div class="max-w-3xl mx-auto mt-12 p-8 bg-white rounded-2xl shadow-lg ring-1 ring-gray-200">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $task->title }}</h1>

    {{-- Description --}}
    <p class="text-gray-700 text-base whitespace-pre-wrap mb-6">
        {{ $task->description ?? 'No description provided.' }}
    </p>

    {{-- Status --}}
    <div class="mb-4">
        <span class="font-semibold text-gray-700">Status:</span>
        @if($task->is_completed)
            <span class="ml-2 inline-block px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full font-medium">Completed</span>
        @else
            <span class="ml-2 inline-block px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full font-medium">Pending</span>
        @endif
    </div>

    {{-- Due Date --}}
    <div class="mb-6">
        <span class="font-semibold text-gray-700">Due Date:</span>
        <span class="ml-2 text-gray-800">
            {{ $task->due_date ? $task->due_date->format('F j, Y') : 'No due date' }}
        </span>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap items-center gap-4 mt-8">
        <a href="{{ route('tasks.edit', $task) }}"
           class="inline-flex items-center px-5 py-2 bg-yellow-500 text-white rounded-lg shadow-sm hover:bg-yellow-600 transition">
            ✏️ Edit Task
        </a>

        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center px-5 py-2 bg-red-600 text-white rounded-lg shadow-sm hover:bg-red-700 transition">
                🗑️ Delete Task
            </button>
        </form>

        <a href="{{ route('tasks.index') }}"
           class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-800 rounded-lg shadow-sm hover:bg-gray-300 transition">
            ← Back to Tasks
        </a>
    </div>
</div>
@endsection

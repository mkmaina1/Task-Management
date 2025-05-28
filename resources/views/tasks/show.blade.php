@extends('layouts.app')

@section('title', 'View Task')

@section('content')
<div class="max-w-3xl mx-auto mt-16 px-6">
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl ring-1 ring-gray-200 dark:ring-gray-700 p-8 space-y-8 transition-all">

        {{-- Task Title & ID --}}
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-1">{{ $task->title }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Task ID: <span class="font-medium">#{{ $task->id }}</span></p>
        </div>

        {{-- Description --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2"> Description</h2>
            <p class="text-base text-gray-700 dark:text-gray-400 whitespace-pre-wrap leading-relaxed">
                {{ $task->description ?? 'No description provided.' }}
            </p>
        </div>

        {{-- Status and Due Date --}}
        <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2"> Status</h2>
                @if($task->is_completed)
                    <span class="inline-block px-4 py-1 bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200 text-sm rounded-full font-medium">
                         Completed
                    </span>
                @else
                    <span class="inline-block px-4 py-1 bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200 text-sm rounded-full font-medium">
                         Pending
                    </span>
                @endif
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2"> Due Date</h2>
                <p class="text-gray-800 dark:text-gray-200">
                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('F j, Y') : 'No due date' }}
                </p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('tasks.edit', $task) }}"
               class="inline-flex items-center px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow transition">
                 Edit Task
            </a>

            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow transition">
                     Delete Task
                </button>
            </form>

            <a href="{{ route('tasks.index') }}"
               class="inline-flex items-center px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white rounded-xl shadow transition">
                ← Back to Tasks
            </a>
        </div>
    </div>
</div>
@endsection

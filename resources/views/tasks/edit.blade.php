@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Title</label>
            <input name="title" class="form-control" value="{{ $task->title }}" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
        </div>
        <button class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection

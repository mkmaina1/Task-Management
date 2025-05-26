@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Task Statistics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks</h5>
                    <p class="card-text">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User List -->
    <div class="card mb-4">
        <div class="card-header">Registered Users</div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Task Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="d-flex gap-2">
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Manage Users</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">View All Tasks</a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Tasks</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalTasks }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Admins</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAdmins }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Reports</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalReports }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Recent Users and Admins</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

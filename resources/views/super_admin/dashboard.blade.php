@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-primary">Super Admin Dashboard</h2>

    {{-- ✅ Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-header fw-semibold">Total Tasks</div>
                <div class="card-body">
                    <h5 class="card-title display-6">{{ $totalTasks }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-header fw-semibold">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title display-6">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-header fw-semibold">Total Admins</div>
                <div class="card-body">
                    <h5 class="card-title display-6">{{ $totalAdmins }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-header fw-semibold">Total Reports</div>
                <div class="card-body">
                    <h5 class="card-title display-6">{{ $totalReports }}</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Optional Summary Card --}}
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-header bg-light fw-bold">Summary Overview</div>
        <div class="card-body d-flex justify-content-around flex-wrap">
            <div><strong>Total Users:</strong> {{ $totalUsers }}</div>
            <div><strong>Total Admins:</strong> {{ $totalAdmins }}</div>
            <div><strong>Total Reports:</strong> {{ $totalReports }}</div>
            <div><strong>Total Tasks:</strong> {{ $totalTasks }}</div>
        </div>
    </div>

    {{-- ✅ Recent Users Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-semibold">Recent Users and Admins</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'warning' : ($user->role === 'super_admin' ? 'dark' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No recent users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

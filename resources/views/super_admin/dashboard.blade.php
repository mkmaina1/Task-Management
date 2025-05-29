@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container py-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 dark:text-white">Super Admin Dashboard</h1>

    <div class="row g-4 mb-6">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-3">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text fs-3">{{ $adminCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning shadow rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Reports Submitted</h5>
                    <p class="card-text fs-3">{{ $reportCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('super_admin.users') }}" class="btn btn-outline-dark btn-lg m-2">Manage Users</a>
        <a href="{{ route('super_admin.reports') }}" class="btn btn-outline-secondary btn-lg m-2">View Reports</a>
    </div>
</div>
@endsection

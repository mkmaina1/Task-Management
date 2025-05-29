@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>

        @if (Auth::user()->isSuperAdmin())
            <p>You are logged in as a <strong>SuperAdmin</strong></p>
        @elseif (Auth::user()->isAdmin())
            <p>You are logged in as an <strong>Admin</strong>.</p>
        @else
            <p>You are logged in as a <strong>User</strong>.</p>
        @endif
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Tasks</h5>
                    <p>{{ $taskCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Completed Tasks</h5>
                    <p>{{ $completedCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Pending Tasks</h5>
                    <p>{{ $pendingCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

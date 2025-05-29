@extends('layouts.app')

@section('title', 'All Reports')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="bi bi-clipboard2-check-fill me-2 text-primary"></i>User Task Reports</h2>
        <a href="{{ route('reports.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Create New Report
            @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

        </a>
    </div>

    @forelse ($reports as $report)
        <div class="card mb-4 shadow-sm border-0 rounded-4">
            <div class="card-body bg-light rounded-4">
                <div class="mb-2 small text-muted">
                    <strong>User:</strong> {{ $report->user->name }} |
                    <strong>Task:</strong> {{ $report->task->title ?? 'Deleted Task' }} |
                    <strong>Date:</strong> {{ $report->created_at->format('M d, Y H:i') }}
                </div>
                <p class="text-dark fw-normal">{{ $report->message }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>No reports submitted yet.
        </div>
    @endforelse
</div>
@endsection

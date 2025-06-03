@extends('layouts.app')

@section('title', 'All Reports')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-clipboard2-check-fill me-2 text-primary"></i>User Task Reports
        </h2>
    </div>

    {{-- ✅ Filter/Search Form --}}
    <form method="GET" action="{{ route('reports.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search reports...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- All--</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-primary">
                <i class="bi bi-filter-circle me-1"></i>Filter
            </button>
        </div>
    </form>

   
    {{-- ✅ Reports List --}}
    @forelse ($reports as $report)
        <div class="card mb-4 shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center rounded-top-4">
                <div class="small text-muted">
                    <span class="fw-semibold">User:</span> {{ $report->user->name }} |
                    <span class="fw-semibold">Task:</span> {{ $report->task->title ?? 'Deleted Task' }}
                </div>
                <span class="badge bg-{{ $report->status === 'pending' ? 'warning' : 'success' }}">
                    {{ ucfirst($report->status) }}
                </span>
            </div>
            <div class="card-body bg-light rounded-bottom-4">
                <div class="mb-2 small text-muted">
                    <i class="bi bi-calendar-event me-1"></i>{{ $report->created_at->format('M d, Y H:i') }}
                </div>
                <p class="mb-2 text-dark fw-semibold">Report:</p>
                <p class="text-dark">{{ $report->message }}</p>

                @if ($report->content)
                    <div class="mt-3">
                        <span class="fw-semibold text-secondary">Report content:</span>
                        <div class="bg-white p-3 rounded-3 border mt-2">
                            {{ $report->content }}
                        </div>
                    </div>
                @endif


                {{-- ✅ Admin/SuperAdmin Reply Section --}}
            @auth
                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <div class="mt-4">
                     @if (auth()->user()->isAdmin())
                      <form action="{{ route('admin.reports.reply', $report->id) }}" method="POST">
                     @endif
                     @if (auth()->user()->isSuperAdmin())
                      <form action="{{ route('super_admin.reports.reply', $report->id) }}" method="POST">
                     @endif
                            @csrf
                            <label for="admin_reply_{{ $report->id }}" class="form-label fw-semibold text-secondary">Reply to Report:</label>
                            <textarea name="admin_reply" id="admin_reply_{{ $report->id }}" rows="2" class="form-control rounded-3 mb-2" placeholder="Type your reply here..." required>{{ $report->admin_reply }}</textarea>
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-send-check-fill me-1"></i>Send Reply
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
            </div>
        </div>

    @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>No reports submitted yet.
        </div>
    @endforelse
   
    {{-- ✅ Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $reports->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

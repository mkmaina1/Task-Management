@extends('layouts.app')

@section('title', 'Manage Users and Admins')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-dark">Manage Users & Admins</h2>
        <p class="text-muted">Promote, demote or delete users as needed</p>
    </div>

    <!-- Search & Filter Form -->
    <form method="GET" action="{{ route('super_admin.manageusers') }}" class="mb-4">
        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">All Roles</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'warning text-dark' : 'secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="d-flex gap-2 flex-wrap">
                                    @if ($user->role === 'user')
                                        <form method="POST" action="{{ route('super_admin.promote', $user) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Promote</button>
                                        </form>
                                    @elseif ($user->role === 'admin')
                                        <form method="POST" action="{{ route('super_admin.demote', $user) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-warning">Demote</button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('super_admin.delete_user', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($users->hasPages())
            <div class="card-footer text-center">
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection

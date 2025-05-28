@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin: User Management</h2>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('admin.users') }}" class="mb-3 d-flex justify-content-between">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email" class="form-control w-50 me-2">
        <select name="role" class="form-control w-25 me-2">
            <option value="">All Roles</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- User List with Task Count -->
    <div class="card mb-4">
        <div class="card-header">Registered Users</div>
        <div class="card-body">
            @if ($users->count())
                <table class="table table-bordered table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tasks</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr @if(auth()->id() === $user->id) class="table-info" @endif>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->tasks_count }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Custom Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $users->onEachSide(1)->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
                </div>
            @else
                <p>No users found.</p>
            @endif
        </div>
    </div>
</div>
@endsection

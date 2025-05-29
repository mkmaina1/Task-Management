@extends('layouts.app')

@section('title', 'Manage Users and Admins')

@section('content')
<div class="container py-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Manage Users & Admins</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge {{ $user->role === 'admin' ? 'bg-info' : 'bg-secondary' }}">{{ ucfirst($user->role) }}</span></td>
                    <td class="d-flex gap-2">
                        @if($user->role === 'user')
                            <form method="POST" action="{{ route('super_admin.promote', $user) }}">
                                @csrf
                                <button class="btn btn-sm btn-success">Promote to Admin</button>
                            </form>
                        @elseif($user->role === 'admin')
                            <form method="POST" action="{{ route('super_admin.demote', $user) }}">
                                @csrf
                                <button class="btn btn-sm btn-warning">Demote to User</button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('super_admin.delete_user', $user) }}" onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

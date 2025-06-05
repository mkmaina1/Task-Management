@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Edit User Details</h4>
                </div>
                <div class="card-body bg-light rounded-bottom-4">
                    <form action="{{ route('admin.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control rounded-3 shadow-sm" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control rounded-3 shadow-sm" required>
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select id="role" name="role" class="form-select rounded-3 shadow-sm" required>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left-circle me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-4 shadow">
                                <i class="bi bi-save-fill me-1"></i>Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

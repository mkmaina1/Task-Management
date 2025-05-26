@extends('layouts.app') {{-- or your main layout --}}

@section('title', 'Settings')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Account Settings</h3>
    </div>
    <div class="card-body">
        {{-- Flash message --}}
        @if (session('success'))
            <div class="alert alert-success flash-message">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <hr class="my-4">

            <h5>Change Password (optional)</h5>
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
            </div>

            <div class="form-group mt-2">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide flash message
    setTimeout(() => {
        const msg = document.querySelector('.flash-message');
        if (msg) msg.remove();
    }, 3000);
</script>
@endpush

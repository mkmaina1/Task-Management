@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 underline">Cancel</a>
        </div>
    </form>
</div>
@endsection

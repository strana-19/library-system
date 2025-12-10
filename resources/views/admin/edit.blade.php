@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-3">✏ Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option {{ $user->role == 'student' ? 'selected' : '' }}>student</option>
                <option {{ $user->role == 'staff' ? 'selected' : '' }}>staff</option>
                <option {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
            </select>
        </div>

        <button class="btn btn-brown w-100">Update</button>
    </form>

    <a href="{{ route('admin.users') }}" class="btn btn-brown mt-3 w-100">⬅ Back</a>
</div>
@endsection

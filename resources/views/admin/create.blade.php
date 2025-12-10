@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-3">➕ Add New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="student">Student</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button class="btn btn-brown w-100">Save</button>
    </form>

    <a href="{{ route('admin.users') }}" class="btn btn-brown mt-3 w-100">⬅ Back</a>
</div>
@endsection

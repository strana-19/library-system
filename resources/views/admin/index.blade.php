@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h2 class="text-center mb-3">👥 Manage Users</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-brown mb-3">➕ Add User</a>

    <table class="table table-bordered">
        <thead style="background-color: burlywood; color: saddlebrown;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>

                <td>
                    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-brown btn-sm">Edit</a>

                    <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>
</div>

@endsection

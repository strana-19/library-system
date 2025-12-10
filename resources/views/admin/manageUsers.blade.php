@extends('layouts.app')

@section('title', 'Admin | Manage Users')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        border-radius: 10px;
        padding: 8px 18px;
        border: none;
        transition: 0.3s;
    }
    .btn-brown:hover { background-color: brown; }

    th {
        background-color: burlywood;
        color: saddlebrown;
    }

    .badge-role {
        background-color: sienna;
        color: white;
        padding: 5px 12px;
        border-radius: 8px;
    }
</style>

<div class="card shadow-sm">
    <div class="card-body">

        <h2 class="text-center mb-4" style="color:sienna;">👥 Manage Users</h2>

        <!-- ADD USER BUTTON -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#addUserModal">
                ➕ Add User
            </button>
        </div>

        <!-- USERS TABLE -->
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        <span class="badge-role">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td>

                        <!-- EDIT BUTTON -->
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editUser{{ $user->id }}">
                            Edit
                        </button>

                        <!-- DELETE BUTTON -->
                        <form action="{{ route('admin.users.delete', $user->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this user?')">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>

                <!-- ===========================
                     EDIT USER MODAL
                ============================ -->
                <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title">✏ Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Name:</label>
                                        <input type="text" name="name"
                                               class="form-control"
                                               value="{{ $user->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Email:</label>
                                        <input type="email" name="email"
                                               class="form-control"
                                               value="{{ $user->email }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Role:</label>
                                        <select name="role" class="form-control">
                                            <option value="admin"   {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="teacher" {{ $user->role=='teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="student" {{ $user->role=='student' ? 'selected' : '' }}>Student</option>
                                            <option value="staff"   {{ $user->role=='staff' ? 'selected' : '' }}>Staff</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Password (optional):</label>
                                        <input type="password" name="password"
                                               class="form-control"
                                               placeholder="Leave blank to keep current password">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-brown" type="submit">
                                        Save Changes
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>

    </div>
</div>


<!-- ===========================
     ADD USER MODAL
=========================== -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.users.add') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">➕ Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-brown" type="submit">Add User</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

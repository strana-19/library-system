@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    .logout-btn {
        background-color: firebrick;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
    }
    .logout-btn:hover { background-color: darkred; }
</style>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between">
        <h2 style="color:sienna;">🛠 Admin Dashboard</h2>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">🚪 Logout</button>
        </form>
    </div>

    <div class="row mt-4">

        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('admin.users') }}" class="btn btn-brown w-75">👥 Manage Users</a>
        </div>

        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('admin.books') }}" class="btn btn-brown w-75">📚 Manage Books</a>
        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        transition: 0.3s;
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
        <h2 style="color:sienna;">📋 Staff Dashboard</h2>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">🚪 Logout</button>
        </form>
    </div>

    <p class="text-secondary">Manage reservations, borrowing, returns, and clearance.</p>

    <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
        <a href="{{ route('staff.reservations') }}" class="btn btn-brown">📅 Manage Reservations</a>
        <a href="{{ route('staff.borrowings') }}" class="btn btn-brown">📚 Process Borrowing</a>
        <a href="{{ route('staff.clearance') }}" class="btn btn-brown">✅ Clearance</a>
    </div>

</div>

@endsection

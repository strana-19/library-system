@extends('layouts.app')

@section('title', 'Staff | Clearance Result')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        padding: 8px 16px;
        border-radius: 10px;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    .status-cleared {
        background-color: forestgreen;
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 18px;
    }

    .status-not-cleared {
        background-color: firebrick;
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 18px;
    }

    .card-title { color: sienna; }
</style>

<div class="card shadow-sm p-4">

    <h2 class="text-center card-title mb-4">📄 Clearance Result</h2>

    <div class="text-center mb-4">
        <h4>{{ $student->name }}</h4>
        <p class="text-secondary">{{ $student->email }}</p>
    </div>

    <div class="row text-center mb-4">

        <div class="col-md-4">
            <h5>📚 Unreturned Books</h5>
            <p class="fs-4 {{ $unreturned > 0 ? 'text-danger' : 'text-success' }}">
                {{ $unreturned }}
            </p>
        </div>

        <div class="col-md-4">
            <h5>💰 Total Penalties</h5>
            <p class="fs-4 {{ $penalty > 0 ? 'text-danger' : 'text-success' }}">
                ₱{{ $penalty }}
            </p>
        </div>

        <div class="col-md-4">
            <h5>📌 Clearance Status</h5>
            @if($isCleared)
                <span class="status-cleared">CLEARED</span>
            @else
                <span class="status-not-cleared">NOT CLEARED</span>
            @endif
        </div>

    </div>

    <div class="text-center">
        <a href="{{ route('staff.clearance') }}" class="btn btn-brown px-4">⬅ Back to Clearance List</a>
        <a href="{{ route('staff.dashboard') }}" class="btn btn-brown px-4">🏠 Dashboard</a>
    </div>

</div>

@endsection

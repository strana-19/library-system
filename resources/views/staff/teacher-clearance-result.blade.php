@extends('layouts.app')

@section('title', 'Teacher Clearance Result')

@section('content')

<div class="card p-4 shadow-sm">
    <h2 class="text-center mb-3" style="color:sienna;">👨‍🏫 Teacher Clearance</h2>

    <h4>{{ $teacher->name }}</h4>
    <p>Email: {{ $teacher->email }}</p>

    <hr>

    <p><b>Unreturned Books:</b> {{ $unreturned }}</p>
    <p><b>Pending Reservations:</b> {{ $pendingReservations }}</p>

    <hr>

    @if($isCleared)
        <div class="alert alert-success text-center">✔ Teacher is CLEARED</div>
    @else
        <div class="alert alert-danger text-center">❌ Teacher is NOT cleared</div>
    @endif

    <a href="{{ route('staff.clearance') }}" class="btn btn-brown mt-3">⬅ Back</a>
</div>

@endsection

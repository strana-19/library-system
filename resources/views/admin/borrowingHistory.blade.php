@extends('layouts.app')

@section('title', 'Borrowing History')

@section('content')
<style>
    body { background-color: beige; font-family: "Georgia", serif; }
    .card { background-color: floralwhite; border: none; border-radius: 15px; box-shadow: 0 6px 20px rgba(139, 94, 52, 0.15); }
    .card-title { color: sienna; font-weight: bold; }
    .btn-brown { background-color: saddlebrown; color: white; border: none; }
    .btn-brown:hover { background-color: brown; }
</style>

<div class="card p-4">
    <h2 class="card-title text-center mb-3">Borrowing History</h2>
    <p class="text-center text-secondary">Track all borrowing and returning activities across the system.</p>

    <table class="table table-bordered mt-4">
        <thead style="background-color: tan; color: white;">
            <tr>
                <th>Borrower</th>
                <th>Book Title</th>
                <th>Date Borrowed</th>
                <th>Date Returned</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Joebert Dela Cruz</td>
                <td>Web Development Essentials</td>
                <td>Oct 10, 2025</td>
                <td>Oct 13, 2025</td>
                <td><span class="badge bg-success">Returned</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

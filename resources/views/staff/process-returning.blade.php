@extends('layouts.app')

@section('title', 'Process Returning')

@section('content')

<style>
    th { background-color: burlywood; color: saddlebrown; }
    .btn-brown { background-color: saddlebrown; color: white; }
    .btn-brown:hover { background-color: brown; }
</style>

<div class="card p-4 shadow-sm">
    <h2 class="text-center mb-3" style="color:sienna;">🔄 Process Book Returns</h2>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Book</th>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Penalty</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($borrowings as $borrow)
                <tr>
                    <td>{{ $borrow->user->name }}</td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->borrowed_at }}</td>
                    <td>{{ $borrow->due_date }}</td>
                    <td>{{ $borrow->penalty }}</td>

                    <td>
                        <form action="{{ route('staff.return', $borrow->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-brown btn-sm">Return Book</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('staff.dashboard') }}" class="btn btn-brown mt-3">⬅ Back</a>
</div>

@endsection

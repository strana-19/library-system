@extends('layouts.app')

@section('title', 'Staff | Process Borrowing')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    th { background-color: burlywood; color: saddlebrown; }

    .badge-late { background-color: firebrick; }
    .badge-ok { background-color: forestgreen; }
</style>

<div class="card shadow-sm p-4">

    <h2 class="text-center mb-4" style="color:sienna;">📚 Active Borrowings</h2>

    <p class="text-center text-secondary">
        These books are currently borrowed and not yet returned.
    </p>

    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Book Title</th>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Penalty</th>
            </tr>
        </thead>

        <tbody>
            @forelse($borrowings as $borrow)
            <tr>
                <td>{{ $borrow->user->name }}</td>
                <td>{{ $borrow->book->title }}</td>

                <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</td>

                <td>
                    @if($borrow->penalty > 0)
                        <span class="badge badge-late">₱{{ $borrow->penalty }}</span>
                    @else
                        <span class="badge badge-ok">None</span>
                    @endif
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No active borrowings found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('staff.dashboard') }}" class="btn btn-brown mt-3">
        ⬅ Back to Dashboard
    </a>

</div>

@endsection

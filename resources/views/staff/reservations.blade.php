@extends('layouts.app')

@section('title', 'Staff | Reservations')

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

    .btn-approve { background-color: seagreen; color: white; border-radius: 8px; padding: 6px 12px; }
    .btn-approve:hover { background-color: forestgreen; }

    .btn-reject { background-color: firebrick; color: white; border-radius: 8px; padding: 6px 12px; }
    .btn-reject:hover { background-color: darkred; }

    th { background-color: burlywood; color: saddlebrown; }

    .badge-pending { background-color: goldenrod; }
    .badge-approved { background-color: forestgreen; }
    .badge-released { background-color: steelblue; }
</style>

<div class="card shadow-sm p-4">

    <h2 class="text-center mb-4" style="color:sienna;">📅 Book Reservations</h2>

    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>Reserved At</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($reservations as $res)
            <tr>
                <td>{{ $res->user->name ?? 'Unknown User' }}</td>
                <td>{{ $res->book->title ?? 'Unknown Book' }}</td>
                <td>{{ \Carbon\Carbon::parse($res->reserved_at)->format('M d, Y h:i A') }}</td>

                <td>
                    @if(!$res->approved_at && !$res->released_at)
                        <span class="badge badge-pending">Pending</span>

                    @elseif($res->approved_at && !$res->released_at)
                        <span class="badge badge-approved">Approved</span>

                    @elseif($res->released_at)
                        <span class="badge badge-released">Released</span>
                    @endif
                </td>

                <td>

                    {{-- APPROVE BUTTON (only if not approved yet) --}}
                    @if(!$res->approved_at)
                    <form action="{{ route('staff.reservation.approve', $res->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-approve btn-sm">Approve</button>
                    </form>
                    @endif

                    {{-- REJECT BUTTON (only if not approved yet) --}}
                    @if(!$res->approved_at)
                    <form action="{{ route('staff.reservation.reject', $res->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-reject btn-sm">Reject</button>
                    </form>
                    @endif

                    {{-- RELEASE BUTTON (only when approved, not released) --}}
                    @if($res->approved_at && !$res->released_at)
                    <form action="{{ route('staff.reservation.release', $res->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-brown btn-sm">Release</button>
                    </form>
                    @endif

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No reservations found.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

    <a href="{{ route('staff.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>

</div>

@endsection

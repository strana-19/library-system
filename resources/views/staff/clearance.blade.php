@extends('layouts.app')

@section('content')

<h2 class="text-center mb-4" style="color:sienna;">📋 Clearance Management</h2>

<div class="card p-4 shadow-sm">

    {{-- STUDENT CLEARANCE --}}
    <h3>🎓 Student Clearance</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unreturned Books</th>
                <th>Total Penalty</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $s)
            <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->borrowings()->whereNull('returned_at')->count() }}</td>
                <td>{{ $s->borrowings()->sum('penalty') }}</td>
                <td>
                    <a href="{{ route('staff.clearance.check', $s->id) }}"
                       class="btn btn-brown btn-sm">
                        Check Clearance
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    {{-- TEACHER CLEARANCE --}}
    <h3 class="mt-4">📘 Teacher Clearance</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Borrowed Books</th>
                <th>Pending Reservations</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($teachers as $t)
            <tr>
                <td>{{ $t->name }}</td>
                <td>{{ $t->borrowings()->whereNull('returned_at')->count() }}</td>
                <td>{{ $t->reservations()->whereNull('approved_at')->count() }}</td>
                <td>
                    <a href="{{ route('staff.teacher.clearance.check', $t->id) }}"
                       class="btn btn-brown btn-sm">
                        Check Clearance
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

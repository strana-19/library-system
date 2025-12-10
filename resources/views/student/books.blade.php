@extends('layouts.app')

@section('title', 'Student | Available Books')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        border-radius: 10px;
        padding: 6px 16px;
        border: none;
    }
    .btn-brown:hover { background-color: brown; }

    .badge-available { background-color: forestgreen; }
    .badge-borrowed { background-color: firebrick; }

    th { background-color: burlywood; color: saddlebrown; }
</style>

<div class="card shadow-sm p-4">

    <h2 class="card-title text-center mb-3">📚 Available Books</h2>

    {{-- SEARCH FORM --}}
    <form method="GET" class="d-flex gap-2 mb-3">
        <input type="text" name="search" class="form-control"
               placeholder="Search title, author, category..."
               value="{{ request('search') }}">

        <select name="category" class="form-select">
            <option value="all">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->category }}"
                    {{ request('category') == $cat->category ? 'selected' : '' }}>
                    {{ $cat->category }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-brown">Search</button>
    </form>


    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>Title</th>
                <th>Author</th>
                <th width="120">Category</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>

                <td>
                    @if($book->copies > 0)
                        <span class="badge badge-available">Available</span>
                    @else
                        <span class="badge badge-borrowed">Borrowed</span>
                    @endif
                </td>

                <td>
                    @if($book->copies > 0)
                        <form action="{{ route('student.reserve', $book->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-brown btn-sm">Reserve</button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Unavailable</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <a href="{{ route('student.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>

</div>

@endsection

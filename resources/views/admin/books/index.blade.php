@extends('layouts.app')

@section('content')

<div class="card p-4">
    <h2 class="text-center text-sienna mb-4">📚 Manage Books</h2>

    <a href="{{ route('admin.books.create') }}" class="btn btn-brown mb-3">➕ Add Book</a>

    <table class="table table-bordered">
        <thead style="background-color: burlywood; color: saddlebrown;">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Availability</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($books as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->title }}</td>
                <td>{{ $b->author }}</td>
                <td>{{ $b->genre }}</td>

                <td>
                    @if($b->available)
                        <span class="badge bg-success">Available</span>
                    @else
                        <span class="badge bg-danger">Borrowed</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.books.edit', $b->id) }}" class="btn btn-brown btn-sm">Edit</a>

                    <form action="{{ route('admin.books.delete', $b->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this book?')">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>
</div>

@endsection

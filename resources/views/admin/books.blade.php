@extends('layouts.app')

@section('title', 'Admin | Manage Books')

@section('content')

<style>
    .btn-brown {
        background-color: saddlebrown;
        color: white;
        border: none;
        transition: 0.3s;
        padding: 10px;
        border-radius: 10px;
    }
    .btn-brown:hover { background-color: brown; }

    th {
        background-color: burlywood;
        color: saddlebrown;
    }

    .badge-low { background-color: goldenrod; }
    .badge-out { background-color: firebrick; }
</style>

<div class="card shadow-sm">
    <div class="card-body">

        <h2 class="text-center mb-4" style="color:sienna;">📚 Manage Books</h2>

        <!-- Add Book Button -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#addBookModal">
                ➕ Add Book
            </button>
        </div>

        <!-- Search + Filter -->
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

        <!-- Books Table -->
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Copies</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($books as $book)
                <tr>

                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category }}</td>
                    <td>{{ $book->copies }}</td>

                    <td>
                        @if($book->copies < 1)
                            <span class="badge badge-out">Out of Stock</span>
                        @elseif($book->copies <= 2)
                            <span class="badge badge-low">Low Stock</span>
                        @else
                            <span class="badge bg-success">Good</span>
                        @endif
                    </td>

                    <td>
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editBook{{ $book->id }}">
                            Edit
                        </button>

                        <form action="{{ route('admin.books.delete', $book->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>

                </tr>

                <!-- ===========================
                     EDIT BOOK MODAL
                ============================ -->
                <div class="modal fade" id="editBook{{ $book->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title">✏ Edit Book</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Title:</label>
                                        <input type="text" name="title" class="form-control"
                                               value="{{ $book->title }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Author:</label>
                                        <input type="text" name="author" class="form-control"
                                               value="{{ $book->author }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Category:</label>
                                        <input type="text" name="category" class="form-control"
                                               value="{{ $book->category }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Copies:</label>
                                        <input type="number" name="copies" class="form-control"
                                               value="{{ $book->copies }}" min="0" required>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-brown" type="submit">Save Changes</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $books->appends(request()->query())->links() }}
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-brown mt-3">⬅ Back to Dashboard</a>

    </div>
</div>

<!-- ===========================
     ADD BOOK MODAL
=========================== -->
<div class="modal fade" id="addBookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.books.add') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">📚 Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Author:</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Category:</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Copies:</label>
                        <input type="number" name="copies" class="form-control" min="1" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-brown" type="submit">Add Book</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

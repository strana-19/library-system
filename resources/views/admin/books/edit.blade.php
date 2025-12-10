@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-3">✏ Edit Book</h2>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
        </div>

        <div class="mb-3">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $book->genre }}">
        </div>

        <div class="mb-3">
            <label>Availability</label>
            <select name="available" class="form-control">
                <option value="1" {{ $book->available == 1 ? 'selected' : '' }}>Available</option>
                <option value="0" {{ $book->available == 0 ? 'selected' : '' }}>Borrowed</option>
            </select>
        </div>

        <button class="btn btn-brown w-100">Update</button>
    </form>

    <a href="{{ route('admin.books') }}" class="btn btn-brown w-100 mt-3">⬅ Back</a>
</div>
@endsection

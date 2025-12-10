@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')

<style>
    .btn-brown { background-color: saddlebrown; color: white; }
    .btn-brown:hover { background-color: brown; }
</style>

<div class="card p-4 shadow-sm" style="max-width:600px; margin:auto;">
    <h2 class="text-center mb-4" style="color:sienna;">✏ Edit Book</h2>

    <form method="POST" action="{{ route('admin.updateBook', $book->id) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $book->genre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Available</label>
            <select name="available" class="form-control">
                <option value="1" {{ $book->available ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$book->available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button class="btn btn-brown w-100 mt-3">Update Book</button>
    </form>

    <a href="{{ route('admin.books') }}" class="btn btn-secondary w-100 mt-3">Cancel</a>
</div>

@endsection

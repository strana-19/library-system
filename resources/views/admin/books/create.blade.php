@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-3">➕ Add New Book</h2>

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Book Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control">
        </div>

        <div class="mb-3">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control">
        </div>

        <button class="btn btn-brown w-100">Save</button>
    </form>

    <a href="{{ route('admin.books') }}" class="btn btn-brown w-100 mt-3">⬅ Back</a>
</div>
@endsection

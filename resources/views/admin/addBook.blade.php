@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
<style>
    body { background-color: beige; font-family: "Georgia", serif; }
    .card {
        background-color: floralwhite;
        border: none;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(139, 94, 52, 0.15);
    }
    .card-title { color: sienna; font-weight: bold; }
    .btn-brown { background-color: saddlebrown; color: white; border: none; }
    .btn-brown:hover { background-color: brown; }
</style>

<div class="card p-4">
    <h2 class="card-title text-center mb-3"> Add New Book</h2>
    <p class="text-center text-secondary">Fill out the form below to add a new book to the library inventory.</p>

    <form class="mt-3">
        <div class="mb-3">
            <label class="form-label">Book Title</label>
            <input type="text" class="form-control" placeholder="Enter book title">
        </div>
        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" class="form-control" placeholder="Enter author name">
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" placeholder="Enter book category">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" class="form-control" placeholder="Enter quantity available">
        </div>

        <button type="submit" class="btn btn-brown w-100">Add Book</button>
    </form>
</div>
@endsection

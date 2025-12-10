@extends('layouts.app')

@section('title', 'Manage Books')

@section('content')
<style>
    body { background-color: beige; font-family: "Georgia", serif; }
    .card { background-color: floralwhite; border: none; border-radius: 15px; box-shadow: 0 6px 20px rgba(139, 94, 52, 0.15); }
    .card-title { color: sienna; font-weight: bold; }
    .btn-brown { background-color: saddlebrown; color: white; border: none; }
    .btn-brown:hover { background-color: brown; }
</style>

<div class="card p-4">
    <h2 class="card-title text-center mb-3"> Manage Books</h2>
    <p class="text-center text-secondary">View, edit, or remove books from the library collection.</p>

    <table class="table table-bordered mt-4">
        <thead style="background-color: tan; color: white;">
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Object-Oriented Programming</td>
                <td>John Smith</td>
                <td>Computer Science</td>
                <td>10</td>
                <td>
                    <button class="btn btn-sm btn-brown">Edit</button>
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

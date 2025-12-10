<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /* ============================
        DASHBOARD
    ============================ */
    public function dashboard()
    {
        $users = User::count();
        $books = Book::count();

        return view('admin.dashboard', compact('users', 'books'));
    }

    /* ============================
        USER MANAGEMENT
    ============================ */
    public function users()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users', compact('users'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return back()->with('success', 'User added!');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => "required|email|unique:users,email,$id",
            'role'  => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'User updated!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin.');
        }

        $user->delete();

        return back()->with('success', 'User deleted!');
    }

    /* ============================
        BOOK MANAGEMENT
    ============================ */
    public function books(Request $request)
    {
        $query = Book::query();

        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('author', 'like', "%{$request->search}%")
                ->orWhere('category', 'like', "%{$request->search}%");
        }

        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $books = $query->orderBy('title')->paginate(10);
        $categories = Book::select('category')->distinct()->get();

        return view('admin.books', compact('books', 'categories'));
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'author'   => 'required',
            'category' => 'required',
            'copies'   => 'required|integer|min:0',
        ]);

        Book::create($request->all());

        return back()->with('success', 'Book added!');
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'    => 'required',
            'author'   => 'required',
            'category' => 'required',
            'copies'   => 'required|integer|min:0',
        ]);

        $book->update($request->all());

        return back()->with('success', 'Book updated!');
    }

    public function deleteBook($id)
    {
        Book::findOrFail($id)->delete();
        return back()->with('success', 'Book deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Reservation;

class StudentController extends Controller
{
    public function dashboard()
    {
        $books = Book::orderBy('title')->paginate(10);
        return view('student.dashboard', compact('books'));
    }

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

        $books = $query->orderBy('title')->get();
        $categories = Book::select('category')->distinct()->get();

        return view('student.books', compact('books', 'categories'));
    }

    public function reserve($bookId)
    {
        $studentId = session('user_id');

        if (!$studentId) return redirect('/')->with('error', 'Session expired.');

        $book = Book::findOrFail($bookId);

        $activeBorrows = Borrowing::where('user_id', $studentId)
            ->whereNull('returned_at')
            ->count();

        if ($activeBorrows >= 3) {
            return back()->with('error', 'You cannot borrow more than 3 books.');
        }

        $existing = Reservation::where('user_id', $studentId)
            ->where('book_id', $bookId)
            ->whereNull('approved_at')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already reserved this book.');
        }

        Reservation::create([
            'user_id'     => $studentId,
            'book_id'     => $bookId,
            'reserved_at' => now(),
        ]);

        return back()->with('success', 'Book reserved successfully!');
    }

    public function history()
    {
        $studentId = session('user_id');

        if (!$studentId) return redirect('/')->with('error', 'Session expired.');

        $history = Borrowing::where('user_id', $studentId)
            ->orderBy('borrowed_at', 'desc')
            ->with('book')
            ->get();

        return view('student.history', compact('history'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Reservation;

class TeacherController extends Controller
{
    public function index(Request $request)
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

        return view('teacher.index', compact('books', 'categories'));
    }

    public function borrowBook(Request $request, $bookId)
    {
        $teacherId = session('user_id');
        if (!$teacherId) return redirect('/')->with('error', 'Session expired.');

        $request->validate([
            'borrow_days' => 'required|integer|min:1|max:30',
        ]);

        $book = Book::findOrFail($bookId);

        if ($book->copies < 1) {
            return back()->with('error', 'Book unavailable.');
        }

        $existing = Borrowing::where('user_id', $teacherId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->first();

        if ($existing) {
            return back()->with('error', 'Already borrowed this book.');
        }

        Borrowing::create([
            'user_id'     => $teacherId,
            'book_id'     => $bookId,
            'borrowed_at' => now(),
            'due_date'    => now()->addDays($request->borrow_days),
        ]);

        $book->copies -= 1;
        $book->save();

        return back()->with('success', 'Book borrowed successfully!');
    }

    public function returnBook($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->returned_at) {
            return back()->with('error', 'Already returned.');
        }

        $borrow->returned_at = now();
        $borrow->save();

        $book = Book::findOrFail($borrow->book_id);
        $book->copies += 1;
        $book->save();

        return back()->with('success', 'Book returned.');
    }

    public function reserveBook($bookId)
    {
        $teacherId = session('user_id');
        if (!$teacherId) return redirect('/')->with('error', 'Session expired.');

        $existing = Reservation::where('user_id', $teacherId)
            ->where('book_id', $bookId)
            ->whereNull('approved_at')
            ->first();

        if ($existing) {
            return back()->with('error', 'Reservation already pending.');
        }

        Reservation::create([
            'user_id'     => $teacherId,
            'book_id'     => $bookId,
            'reserved_at' => now(),
        ]);

        return back()->with('success', 'Book reserved successfully!');
    }

    public function history()
    {
        $teacherId = session('user_id');

        $history = Borrowing::where('user_id', $teacherId)
            ->orderBy('borrowed_at', 'desc')
            ->with('book')
            ->get();

        return view('teacher.history', compact('history'));
    }

    public function reservations()
    {
        $teacherId = session('user_id');

        $reservations = Reservation::where('user_id', $teacherId)
            ->with('book')
            ->orderBy('reserved_at', 'desc')
            ->get();

        return view('teacher.reservations', compact('reservations'));
    }
}

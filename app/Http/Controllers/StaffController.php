<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Reservation;
use App\Models\User;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard');
    }

    public function viewReservations()
    {
        $reservations = Reservation::with('book', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('staff.reservations', compact('reservations'));
    }

    public function approveReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->approved_at) {
            return back()->with('error', 'Already approved.');
        }

        $book = Book::findOrFail($reservation->book_id);

        if ($book->copies < 1) {
            return back()->with('error', 'No copies available.');
        }

        $reservation->approved_at = now();
        $reservation->save();

        return back()->with('success', 'Reservation approved!');
    }

    public function rejectReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->approved_at) {
            return back()->with('error', 'Cannot reject approved reservation.');
        }

        $reservation->delete();

        return back()->with('success', 'Reservation rejected.');
    }

    public function releaseBook($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!$reservation->approved_at) {
            return back()->with('error', 'Approve first.');
        }

        $book = Book::findOrFail($reservation->book_id);

        if ($book->copies < 1) {
            return back()->with('error', 'No copies available.');
        }

        Borrowing::create([
            'user_id' => $reservation->user_id,
            'book_id' => $reservation->book_id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(7),
            'penalty' => 0,
        ]);

        $book->copies -= 1;
        $book->save();

        $reservation->released_at = now();
        $reservation->save();

        return back()->with('success', 'Book released!');
    }

    public function processBorrowing()
    {
        $borrowings = Borrowing::with('user', 'book')
            ->whereNull('returned_at')
            ->get();

        return view('staff.process-borrowing', compact('borrowings'));
    }

    public function staffReturn($id)
    {
        $borrow = Borrowing::findOrFail($id);

        if ($borrow->returned_at) {
            return back()->with('error', 'Already returned.');
        }

        $penalty = $borrow->penalty;

        $borrow->returned_at = now();
        $borrow->penalty = $penalty;
        $borrow->save();

        $book = Book::findOrFail($borrow->book_id);
        $book->copies += 1;
        $book->save();

        return back()->with('success', 'Return processed!');
    }

    public function clearance()
    {
        $students = User::where('role', 'student')->get();
        $teachers = User::where('role', 'teacher')->get();

        return view('staff.clearance', compact('students', 'teachers'));
    }

    public function checkTeacherClearance($id)
    {
        $teacher = User::find($id);

        if (!$teacher || $teacher->role !== 'teacher') {
            return back()->with('error', 'Teacher not found.');
        }

        $unreturned = Borrowing::where('user_id', $id)
            ->whereNull('returned_at')
            ->count();

        $pendingReservations = Reservation::where('user_id', $id)
            ->whereNull('approved_at')
            ->count();

        $isCleared = ($unreturned == 0 && $pendingReservations == 0);

        return view('staff.teacher-clearance-result', compact(
            'teacher',
            'unreturned',
            'pendingReservations',
            'isCleared'
        ));
    }

    public function checkClearance($id)
    {
        $student = User::find($id);

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        $unreturned = Borrowing::where('user_id', $id)
            ->whereNull('returned_at')
            ->count();

        $penalty = Borrowing::where('user_id', $id)->sum('penalty');

        $isCleared = ($unreturned == 0 && $penalty == 0);

        return view('staff.clearance-result', compact(
            'student',
            'unreturned',
            'penalty',
            'isCleared'
        ));
    }
}

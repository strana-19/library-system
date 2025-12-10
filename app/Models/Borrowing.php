<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'penalty',
    ];

    // Borrow belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Borrow belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Penalty rules:
     *
     * - STUDENT: If not returned → penalty = book price
     * - TEACHER: Normal overdue penalty (₱5 per day)
     */
    public function getPenaltyAttribute()
    {
        $user = $this->user;
        $book = $this->book;

        // If already returned → return stored penalty
        if (!is_null($this->returned_at)) {
            return $this->attributes['penalty'];
        }

        // STUDENT RULE (full book price)
        if ($user && $user->role === 'student') {
            return $book ? $book->price : 0;
        }

        // TEACHER RULE (₱5/day overdue)
        $due = Carbon::parse($this->due_date);
        $now = Carbon::now();
        $daysLate = $due->diffInDays($now, false);

        return $daysLate > 0 ? $daysLate * 5 : 0;
    }
}

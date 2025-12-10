<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'reserved_at',
        'approved_at',
        'released_at',
    ];

    // Auto-convert timestamps to Carbon
    protected $casts = [
        'reserved_at' => 'datetime',
        'approved_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    // Reservation belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Reservation belongs to book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Helper: check if pending
    public function getIsPendingAttribute()
    {
        return is_null($this->approved_at);
    }

    // Helper: check if approved but not released
    public function getIsApprovedAttribute()
    {
        return !is_null($this->approved_at) && is_null($this->released_at);
    }

    // Helper: check if released into borrowing
    public function getIsReleasedAttribute()
    {
        return !is_null($this->released_at);
    }
}

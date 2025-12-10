<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'copies',
    ];

    // Relationship: A book has many borrow records
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    // Relationship: A book has many reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Helper: Low stock warning
    public function getIsLowStockAttribute()
    {
        return $this->copies <= 2;
    }

    // Helper: No available copies
    public function getIsUnavailableAttribute()
    {
        return $this->copies < 1;
    }
}

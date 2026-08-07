<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = [
        'member_id',
        'book_id',
        'borrowed_at',
        'due_at',
        'returned_at',
        'status',
        'fine',
        'notes',
    ];

    protected $casts = [
        'borrowed_at' => 'date',
        'due_at' => 'date',
        'returned_at' => 'date',
        'fine' => 'decimal:2',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}

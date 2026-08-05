<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnBook extends Model
{
    protected $fillable = [
        'borrowing_id',
        'returned_at',
        'condition',
        'notes',
    ];

    protected $casts = [
        'returned_at' => 'date',
    ];

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }
}

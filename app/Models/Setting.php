<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'library_name',
        'address',
        'phone',
        'email',
        'max_books',
        'borrow_days',
        'fine_per_day',
    ];

    protected $casts = [
        'max_books' => 'integer',
        'borrow_days' => 'integer',
        'fine_per_day' => 'decimal:2',
    ];
}

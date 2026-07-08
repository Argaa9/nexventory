<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'borrow_code',
        'borrower_name',
        'division',
        'phone',
        'borrow_date',
        'return_date',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(
            BorrowingDetail::class
        );
    }
}
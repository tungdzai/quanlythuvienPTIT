<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetails extends Model
{
    use HasFactory;
    public $table='borrowing_details';
    protected $fillable=[
        'borrowing_id',
        'book_id',
        'quantity',
        'borrowed_date',
        'returned_date',
        'due_date',
        'penalty_fee',

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowings extends Model
{
    use HasFactory;
    public $table='borrowings';
    protected $fillable=[
        'reader_id'
    ];
}

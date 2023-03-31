<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBarcodes extends Model
{
    use HasFactory;
    public $table='book_barcodes';
    protected $fillable=[
      'book_id',
      'barcode'
    ];
}

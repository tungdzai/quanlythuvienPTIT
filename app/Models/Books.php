<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    public $table="books";
    protected $fillable=[
      'title',
      'author',
      'year',
      'price',
      'quantity',
      'description',
      'created_at',
      'updated_at'
    ];
}

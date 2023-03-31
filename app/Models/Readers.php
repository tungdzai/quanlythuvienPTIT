<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readers extends Model
{
    use HasFactory;

    public $table = "readers";
    protected $fillable = [
        'name',
        'date_of_birth',
        'address',
        'phone',
        'barcode',

    ];
}

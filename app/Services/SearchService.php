<?php

namespace App\Services;

use App\Models\Books;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;

class SearchService
{
    public function search($keyword)
    {
        if (!empty($keyword)) {
             return Books::where('title', 'LIKE', '%' . $keyword . '%')->paginate(10);
        }
    }
}

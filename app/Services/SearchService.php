<?php

namespace App\Services;

use App\Models\Books;
use App\Models\BorrowingDetails;

class SearchService
{
    public function search($keyword)
    {
        if (!empty($keyword)) {
            return Books::where('title', 'LIKE', '%' . $keyword . '%')->paginate(10);
        }
    }

    public function searchBooksBorrow($start_date, $end_date)
    {
        if (!empty($start_date) && !empty($end_date)) {
            return  BorrowingDetails::join('books', 'books.id', '=', 'borrowing_details.book_id')
                ->join('book_barcodes', 'books.id', '=', 'book_barcodes.book_id')
                ->select(
                    'book_barcodes.barcode as book_barcode',
                    'books.title as book_name',
                    'books.author as book_author'
                )
                ->selectRaw('count(borrowing_details.book_id) as borrow_count')
                ->groupBy('borrowing_details.book_id', 'book_barcodes.barcode', 'books.title', 'books.author')
                ->orderBy('borrow_count', 'desc')
                ->whereBetween('borrowed_date', [$start_date, $end_date])
                ->get();
        }
    }
}

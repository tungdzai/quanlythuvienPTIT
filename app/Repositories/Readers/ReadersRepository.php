<?php

namespace App\Repositories\Readers;

use App\Models\BookBarcodes;
use App\Models\Readers;
use App\Models\BorrowingDetails;
use App\Models\Borrowings;

class ReadersRepository implements ReadersRepositoryInterface
{

    public function getReader($barcode_reader, $barcode_book)
    {
        // Thông tin độc giả
        $reader = Readers::select(
            'readers.id as readers_id',
            'readers.name as readers_name',
            'readers.date_of_birth as readers_date_of_birth',
            'readers.address as readers_address',
            'readers.phone as readers_phone',
            'readers.barcode as readers_barcode',
            'borrowings.id as borrowing_id'
        )
            ->join('borrowings', 'borrowings.reader_id', '=', 'readers.id')
            ->where('barcode', $barcode_reader)
            ->first();


        $query = BorrowingDetails::select(

            'borrowing_details.quantity as borrowing_details_quantity',
            'borrowing_details.borrowed_date as borrowing_details_borrowed_date',
            'borrowing_details.returned_date as borrowing_details_returned_date',
            'borrowing_details.due_date as borrowing_details_due_date',
            'borrowing_details.penalty_fee as borrowing_details_penalty_fee',

            'books.title as book_name',
            'books.author as book_author',
            'books.price as book_price',
            'books.id as book_id'
        )
            ->join('books', 'borrowing_details.book_id', '=', 'books.id');

        // Danh sách sách mượn
        if ($barcode_reader && empty($barcode_book)) {
            $borrowingDetail = $query
                ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
                ->join('readers', 'borrowings.reader_id', '=', 'readers.id')
                ->where('readers.barcode', $barcode_reader)
                ->where('borrowing_details.flag_delete', 0)
                ->get();
            return [
                'reader' => $reader,
                'borrowingDetail' => $borrowingDetail,
            ];

        }

        if ($barcode_book && $barcode_reader) {
            // Thông tin trả sách
            $borrowing_return = $query
                ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
                ->join('readers', 'borrowings.reader_id', '=', 'readers.id')
                ->join('book_barcodes', 'book_barcodes.book_id', '=', 'books.id')
                ->where('readers.barcode', $barcode_reader)
                ->where('book_barcodes.barcode', $barcode_book)
                ->first();
        }
        return [
            'reader' => $reader,
            'borrowingReturn' => $borrowing_return,
        ];
    }

    public function updateBorrowingDetail($barcode_reader, $barcode_book, $returned_date)
    {
        return BorrowingDetails::join('books', 'borrowing_details.book_id', '=', 'books.id')
            ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
            ->join('readers', 'borrowings.reader_id', '=', 'readers.id')
            ->join('book_barcodes', 'book_barcodes.book_id', '=', 'books.id')
            ->where('readers.barcode', $barcode_reader)
            ->where('book_barcodes.barcode', $barcode_book)
            ->update([
                'returned_date' => $returned_date
            ]);
    }

    public function infoReader($reader_id)
    {
        if ($reader_id) {
            return Readers::select(
                'id as reader_id',
                'name as reader_name',
                'barcode as reader_barcode')
                ->where('id', $reader_id)
                ->first();
        }
    }
}

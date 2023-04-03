<?php

namespace App\Repositories\Borrowings;

use App\Models\BookBarcodes;
use App\Models\Books;
use App\Models\BorrowingDetails;

class BorrowingsRepository implements BorrowingsRepositoryInterface
{
    /**
     * @param $data
     * @return void
     */
    public function addBorrowing($data)
    {
        if ($data) {
            return BorrowingDetails::create($data);
        }
    }

    /**
     * @param $borrowing_id
     * @param $book_id
     * @return void
     */
    public function deleteBook($borrowing_id, $book_id)
    {
        if ($borrowing_id && $book_id) {
            $detail = BorrowingDetails::where('borrowing_id', $borrowing_id)
                ->where('book_id', $book_id);
//            increment
            // Tăng lại sách
            Books::where('id', $book_id)->increment('quantity');
            return $detail->update([
                'flag_delete' => 1
            ]);
        }
    }

    /**
     * @param $borrowing_id
     * @param $book_id
     * @param $penalty_fee
     * @return mixed
     */
    public function penalty_fee($borrowing_id, $book_id, $penalty_fee)
    {
        $detail = BorrowingDetails::where('borrowing_id', $borrowing_id)
            ->where('book_id', $book_id);
        return $detail->update([
            'penalty_fee' => $penalty_fee,
            'flag_delete' => 1
        ]);
    }

    public function borrowReader($borrowing_id)
    {
        if ($borrowing_id) {
            return BorrowingDetails::select(
                'books.title as book_name',
                'books.author as book_author',
                'book_barcodes.barcode as book_barcode',

                'borrowing_details.quantity as borrowing_details_quantity',
                'borrowing_details.borrowed_date as borrowing_details_borrowed_date',
                'borrowing_details.due_date as borrowing_details_due_date',
            )
                ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
                ->join('books', 'borrowing_details.book_id', '=', 'books.id')
                ->join('book_barcodes', 'books.id', '=', 'book_barcodes.book_id')
                ->where('borrowing_details.borrowing_id', $borrowing_id)
                ->where('borrowing_details.flag_delete', 0)
                ->get();
        }
    }

    public function penaltyReader($borrowing_id)
    {
        if ($borrowing_id) {
            return BorrowingDetails::select(
                'books.title as book_name',
                'books.author as book_author',
                'book_barcodes.barcode as book_barcode',

                'borrowing_details.quantity as borrowing_details_quantity',
                'borrowing_details.borrowed_date as borrowing_details_borrowed_date',
                'borrowing_details.due_date as borrowing_details_due_date',
                'borrowing_details.returned_date as borrowing_details_returned_date',
                'borrowing_details.penalty_fee as borrowing_details_penalty_fee',
            )
                ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
                ->join('books', 'borrowing_details.book_id', '=', 'books.id')
                ->join('book_barcodes', 'books.id', '=', 'book_barcodes.book_id')
                ->where('borrowing_details.borrowing_id', $borrowing_id)
                ->where('borrowing_details.flag_delete', 1)
                ->where('borrowing_details.penalty_fee', "!=", null)
                ->get();
        }
    }


    public function historyBooksBorrow()
    {
        return BorrowingDetails::join('books', 'books.id', '=', 'borrowing_details.book_id')
            ->join('book_barcodes', 'books.id', '=', 'book_barcodes.book_id')
            ->select(
                'book_barcodes.barcode as book_barcode',
                'books.title as book_name',
                'books.author as book_author'
            )
            ->selectRaw('count(borrowing_details.book_id) as borrow_count')
            ->groupBy('borrowing_details.book_id', 'book_barcodes.barcode', 'books.title', 'books.author')
            ->orderBy('borrow_count', 'desc')
            ->get();
    }


    public function historyReaders($barcode)
    {
        $reader_list = BorrowingDetails::select(
            'readers.name',
            'borrowing_details.borrowed_date',
            'borrowing_details.returned_date',
            'borrowing_details.penalty_fee',
        )
            ->join('borrowings', 'borrowings.id', '=', 'borrowing_details.borrowing_id')
            ->join('readers', 'borrowings.reader_id', '=', 'readers.id')
            ->join('book_barcodes', 'borrowing_details.book_id', '=', 'book_barcodes.book_id')
            ->where('book_barcodes.barcode', '=', $barcode)
            ->get();
        $book_name = BookBarcodes::select(
            'books.title'
        )
            ->join('books', 'books.id', '=', 'book_barcodes.book_id')
            ->where('book_barcodes.barcode', '=', $barcode)
            ->first();
        return [
            'reader_list' => $reader_list,
            'book_name' => $book_name
        ];

    }

}

<?php

namespace App\Repositories\Borrowings;

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
            return $detail->delete();
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
            'penalty_fee' => $penalty_fee
        ]);
    }

    public function borrowReader($borrowing_id)
    {
        if ($borrowing_id) {
            $borrow_book_list = BorrowingDetails::select(
                'books.title as book_name',
                'books.author as book_author',
                'book_barcodes.barcode as book_barcode',

                'borrowing_details.quantity as borrowing_details_quantity',
                'borrowing_details.borrowed_date as borrowing_details_borrowed_date',
                'borrowing_details.due_date as borrowing_details_due_date',
            )
                ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
                ->join('books', 'borrowing_details.book_id', '=', 'books.id')
                ->join('book_barcodes','books.id','=','book_barcodes.book_id')
                ->where('borrowing_details.borrowing_id', $borrowing_id)
                ->where('borrowing_details.flag_delete' , 0)
                ->get();
            return $borrow_book_list;

        }
    }

}

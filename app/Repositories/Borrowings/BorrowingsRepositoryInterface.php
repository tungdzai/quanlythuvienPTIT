<?php
namespace App\Repositories\Borrowings;

interface BorrowingsRepositoryInterface{
    public function borrowReader($borrowing_id);
    public function addBorrowing($data);
    public function deleteBook($borrowing_id,$book_id);
    public function penalty_fee($borrowing_id,$book_id,$penalty_fee);
}

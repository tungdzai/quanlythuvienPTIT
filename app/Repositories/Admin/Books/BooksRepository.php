<?php

namespace App\Repositories\Admin\Books;

use App\Repositories\Admin\Books\BooksRepositoryInterface;
use App\Models\Books;
use App\Models\BookBarcodes;

class BooksRepository implements BooksRepositoryInterface
{
    /** handle paginate
     * @param $param
     * @return void
     */
    public function paginate($param)
    {
        if ($param) {
            return Books::paginate($param);
        }
    }

    public function allBooks()
    {
        // TODO: Implement allBooks() method.
    }

    public function addBook($data)
    {
        if ($data) {
            return Books::create($data);
        }

    }

    public function getBook($id)
    {
        if (!empty($id)) {
            return Books::select('id', 'title', 'author', 'year', 'price', 'quantity', 'description')->where('id', $id)->first();
        }
        return false;
    }

    public function updateBook($data, $id): bool
    {
        if (!empty($data) && !empty($id)) {
            return Books::where('id', $id)->update($data);
        }
        return false;
    }

    public function deleteBook($id)
    {
        if ($id) {
            return Books::find($id)->delete();
        }
        return false;
    }


    public function bookBarcode($book_barcode)
    {

        if (!empty($book_barcode)) {
            return BookBarcodes::select(
                'books.id as book_id',
                'books.quantity as book_quantity'
            )->join('books', 'books.id', '=', 'book_barcodes.book_id')->where('book_barcodes.barcode',$book_barcode)->first();
        }

    }
}

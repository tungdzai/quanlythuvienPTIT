<?php

namespace App\Repositories\Admin\Books;
interface BooksRepositoryInterface
{
    public function paginate($param);
    public function allBooks();
    public function addBook($data);
    public function getBook($id);
    public function updateBook($data,$id);
    public function deleteBook($id);
    public function bookBarcode($book_barcode);
}

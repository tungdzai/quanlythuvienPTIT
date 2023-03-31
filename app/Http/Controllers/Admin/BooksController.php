<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\AddRequest;
use Carbon\Traits\Date;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Admin\Books\BooksRepositoryInterface;

class BooksController extends Controller
{
    public $booksRepository;

    public function __construct(BooksRepositoryInterface $booksRepository)
    {
        $this->booksRepository = $booksRepository;
    }

    public function index()
    {
        $books = $this->booksRepository->paginate(10);
        $data['books'] = $books;
        return view('admin.pages.books.list_books', $data);
    }

    public function addBook()
    {
        return view("admin.pages.books.add");
    }

    public function handleAddBook(AddRequest $request)
    {

        $book = [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'created_at' => Date(Carbon::now('Asia/Ho_Chi_Minh')),
        ];
        $status = $this->booksRepository->addBook($book);
        if ($status) {
            session()->flash("successAdd", 'Thêm mới thành công');
        }
        session()->flash("errorAdd", 'Thêm mới không thành công !');
        return redirect()->route('admin.books');
    }

    public function updateBook($id)
    {
        if (!empty($id)) {
            $book = $this->booksRepository->getBook($id);
            if ($book) {
                $data['book'] = $book;
                session()->put('id', $id);
                return view('admin.pages.books.update', $data);
            }
            return redirect()->route('admin.books');
        }
    }

    public function handleUpdateBook(AddRequest $request)
    {
        $id = session('id');
        if (!empty($id)) {
            $update_book = [
                'title' => $request->input('title'),
                "author" => $request->input('author'),
                "year" => $request->input('year'),
                "price" => $request->input('price'),
                "quantity" => $request->input('quantity'),
                "description" => $request->input('description'),
                'updated_at' => Date(Carbon::now('Asia/Ho_Chi_Minh')),
            ];
            $status = $this->booksRepository->updateBook($update_book, $id);
            if ($status) {
                session()->flash("successUpdate", "Cập nhật thành công ");
                return redirect()->route('admin.books');
            }
            session()->flash('errorUpdate', "Cập nhật không thành công ! ");
            return redirect()->route('admin.books');
        }
    }

    public function deleteBook()
    {
        $id = session('id');
        $book = $this->booksRepository->getBook($id);
        if ($book){
            $status = $this->booksRepository->deleteBook($id);
            if ($status){
                session()->flash("successDelete", "Xóa thành công ");
                return redirect()->route('admin.books');
            }
            session()->flash('errorDelete', "Xóa không thành công ! ");
            return redirect()->route('admin.books');
        }
    }


}

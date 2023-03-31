<?php

namespace App\Http\Controllers\Readers;

use App\Http\Controllers\Controller;
use App\Models\BookBarcodes;
use App\Models\BorrowingDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Readers\ReadersRepositoryInterface;
use App\Repositories\Admin\Books\BooksRepositoryInterface;
use App\Repositories\Borrowings\BorrowingsRepositoryInterface;

class ReaderController extends Controller
{
    public $readersRepository, $booksRepository, $borrowingsRepository;

    public function __construct(ReadersRepositoryInterface $readersRepository, BooksRepositoryInterface $booksRepository, BorrowingsRepositoryInterface $borrowingsRepository)
    {
        $this->readersRepository = $readersRepository;
        $this->booksRepository = $booksRepository;
        $this->borrowingsRepository = $borrowingsRepository;
    }

    public function index()
    {
        return view('users.pages.readers.reader_barcode');
    }

    public function handleBarcode(Request $request)
    {
        $messages = [
            'barcode.required' => 'Barcode không được để trống !',
            'barcode.exists' => 'Barcode không tồn tại trên hệ thống !'
        ];
        $request->validate([
            'barcode' => 'required|exists:readers,barcode'
        ], $messages);

        $barcode_reader = $request->input('barcode');
        session()->put('barcode_reader', $barcode_reader);
        $reader = $this->readersRepository->getReader($barcode_reader, null);
        if ($reader['reader']->borrowing_id) {
            session()->put('borrowing_id', $reader['reader']->borrowing_id);
        }
        $data['readerInfo'] = $reader;
        return view('users.pages.readers.readerInfo', $data);
    }

    public function bookList()
    {
        $barcode_reader = session('barcode_reader');
        $reader = $this->readersRepository->getReader($barcode_reader, null);
        $data['readerInfo'] = $reader;
        session()->put('countBooks', count($reader['borrowingDetail']));
        return view('users.pages.readers.readerInfo', $data);
    }

    public function bookBarcodes(Request $request)
    {
        $countBooks = session('countBooks');
        $book_barcodes = $request->input('bookBarcode');

        $book = $this->booksRepository->bookBarcode($book_barcodes);
        $book_id = $book->book_id;
        if ($book->book_quantity <= 0) {
            session()->flash('errorAdd', "Sách tạm hết ! ");
            return redirect()->route('user.book.bookList');
        }
        $dateString = Carbon::now('Asia/Ho_Chi_Minh');
        $dateTime = Carbon::parse($dateString);
        $borrowed_date = $dateTime->toDateString();

        $today = Carbon::parse($borrowed_date);
        $due_date = $today->addMonths(1); // Thêm 1 tháng vào ngày hiện tại
        $due_date = $due_date->toDateString();
        if (!empty($book)) {
            $borrowing_details = [
                'book_id' => $book_id,
                'borrowing_id' => session('borrowing_id'),
                'quantity' => 1,
                'borrowed_date' => $borrowed_date,
                'due_date' => $due_date,
            ];

            if ($countBooks < 5) {
                $this->borrowingsRepository->addBorrowing($borrowing_details);
                BookBarcodes::join('books', 'books.id', '=', 'book_barcodes.book_id')->where('book_barcodes.barcode', $book_barcodes)->decrement('books.quantity');
                session()->flash('successAdd', "Thêm thành công ");
            }
            session()->flash('errorAdd', "Vượt quá số sách muốn mượn ! ");
        }
        return redirect()->route('user.book.bookList');
    }

    public function showBook(Request $request)
    {
        $barcode_book = $request->input('bookBarcode');
        $barcode_reader = session('barcode_reader');
        $today_date = Carbon::now('Asia/Ho_Chi_Minh');
        $dateTime = Carbon::parse($today_date);
        $returned_date = $dateTime->toDateString();
        $status_return_book = $this->readersRepository->updateBorrowingDetail($barcode_reader, $barcode_book, $returned_date);
        if ($status_return_book) {
            $statusBook = $this->readersRepository->getReader($barcode_reader, $barcode_book);
        }
        session()->put('returnBook', $statusBook);
        $data['bookReturn'] = $statusBook;
        return view('users.pages.borrowings.showBook', $data);
    }

    public function handleReturnBook()
    {
        $returnBook = session('returnBook');
        $reader = $returnBook['reader'];
        $borrowingReturn = $returnBook['borrowingReturn'];
        $borrowing_id = $reader['borrowing_id'];
        $book_id = $borrowingReturn['book_id'];
        // Đúng hạn
        if ($borrowingReturn->borrowing_details_returned_date < $borrowingReturn->borrowing_details_due_date) {

            $statusReturnBook = $this->borrowingsRepository->deleteBook($borrowing_id, $book_id);
            if ($statusReturnBook) {
                session()->flash('successDelete','Trả sách thành công');
                return redirect()->route('user.book.bookList');
            }

        } else {
            // Quá hạn
            $penalty_fee=($borrowingReturn['book_price'])/5;
            $status_penalty=$this->borrowingsRepository->penalty_fee($borrowing_id,$book_id,$penalty_fee);
            dd($status_penalty);
        }

    }
}

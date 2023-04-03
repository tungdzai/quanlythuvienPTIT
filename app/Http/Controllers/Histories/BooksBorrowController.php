<?php

namespace App\Http\Controllers\Histories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Borrowings\BorrowingsRepositoryInterface;

class BooksBorrowController extends Controller
{
    public $borrowingsRepository;

    public function __construct(BorrowingsRepositoryInterface $borrowingsRepository)
    {
        $this->borrowingsRepository = $borrowingsRepository;
    }

    public function index()
    {
        $historyBooksBorrow = $this->borrowingsRepository->historyBooksBorrow();
        $data["historyBooksBorrow"] = $historyBooksBorrow;
        return view('admin.pages.histories.books', $data);
    }

    public function listReader($barcode)
    {
        if (!empty($barcode)) {
            $historyReader=$this->borrowingsRepository->historyReaders($barcode);
            $data['historyReader']=$historyReader;
            return view('admin.pages.histories.histories_list.reader_list',$data);
        }

    }

}

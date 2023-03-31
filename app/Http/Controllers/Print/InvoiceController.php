<?php

namespace App\Http\Controllers\Print;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Readers\ReadersRepositoryInterface;
use App\Repositories\Borrowings\BorrowingsRepositoryInterface;
use Barryvdh\DomPDF\PDF;

class InvoiceController extends Controller
{
    public $readersRepository, $borrowingsRepository;

    public function __construct(ReadersRepositoryInterface $readersRepository, BorrowingsRepositoryInterface $borrowingsRepository)
    {
        $this->readersRepository = $readersRepository;
        $this->borrowingsRepository = $borrowingsRepository;
    }

    public function bookBill(Request $request)
    {
        $reader_id = $request->get('reader_id');
        $borrowing_id = $request->get('borrowing_id');
        if (!empty($reader_id) && !empty($borrowing_id)) {
            $reader = $this->readersRepository->infoReader($reader_id);
            $borrowing_lists = $this->borrowingsRepository->borrowReader($borrowing_id);
        }
        if (count($borrowing_lists) > 0) {
            $data['reader'] = $reader;
            $data['borrowing_lists'] = $borrowing_lists;
        }
//        dd($borrowing_lists);
        $pdf = app(PDF::class);
        $pdf->loadView('print.invoice', $data);
        return $pdf->stream('danh_sach_san_pham.pdf');
    }
}

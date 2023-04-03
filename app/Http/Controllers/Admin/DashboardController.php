<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SumBookBorrowService;

class DashboardController extends Controller
{
    public $sumBorrowBooks;

    public function __construct(SumBookBorrowService $sumBorrowBooks)
    {
        $this->sumBorrowBooks = $sumBorrowBooks;
    }

    public function index()
    {
        $sumBorrowBooks = $this->sumBorrowBooks->sumBook();
        $data['sumBorrowBooks']=$sumBorrowBooks;
        $data['admin'] = session('admin');
        return view("admin.pages.dashboard", $data);
    }
}

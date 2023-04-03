<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Request;
use App\Repositories\Admin\Books\BooksRepository;

class SearchController extends Controller
{
    public $searchService, $booksRepository;

    public function __construct(SearchService $searchService, BooksRepository $booksRepository)
    {
        $this->searchService = $searchService;
        $this->booksRepository = $booksRepository;
    }

    public function searchBook(Request $request)
    {
        $search = $request->input('searchBook');
        if (empty($search)) {
            $book_search = $this->booksRepository->paginate(10);
        } else {
            $book_search = $this->searchService->search($search);
        }
        session()->flash("titleSearch", $request->input("searchBook"));
        $data['books'] = $book_search;
        if (empty($search)) {
            return redirect()->route('admin.books');
        }
        return view('admin.pages.books.list_books', $data);
    }

    public function handleBookBorrow(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if (!empty($start_date) && !empty($end_date)) {
            $booksBorrow = $this->searchService->searchBooksBorrow($start_date, $end_date);
            $data["historyBooksBorrow"] = $booksBorrow;
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            return view('admin.pages.histories.books', $data);
        } else {
            return  redirect()->route('admin.histories.bookBorrow');
        }

    }
}

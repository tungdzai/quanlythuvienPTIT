<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\Readers\ReaderController;
use App\Http\Controllers\Print\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*Router auth*/
Route::prefix('auth')->name("auth.")->group(function () {
    /*Admin*/
    Route::get('/admin', [AuthAdminController::class, 'login'])->name("adminLogin");
    Route::post('/admin', [AuthAdminController::class, 'handleLogin'])->name("handleLogin");

    /*Nhân viên*/
        Route::get('/user', [AuthUserController::class, 'login'])->name("userLogin");
    Route::post('/user', [AuthUserController::class, 'handleUserLogin'])->name("handleUserLogin");

});

/*Route Admin*/
Route::prefix('auth/admin')->middleware("auth:admin")->name('admin.')->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/books", [BooksController::class, 'index'])->name('books');
    Route::get("/users", [UsersController::class, 'index'])->name('users');

    /*Book*/
    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/add', [BooksController::class, 'addBook'])->name('add');
        Route::post('/add', [BooksController::class, 'handleAddBook'])->name('handleAddBook');
        Route::get('/update/{id_book}', [BooksController::class, 'updateBook'])->name('update');
        Route::post('/update/{id_book}', [BooksController::class, 'handleUpdateBook'])->name('handleUpdateBook');
        Route::get('/delete', [BooksController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/search', [SearchController::class, 'searchBook'])->name('search');
    });
    /*User*/
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/add', [UsersController::class, 'addUser'])->name('add');
        Route::post('/add', [UsersController::class, 'handleAddUser'])->name('handleAddUser');
    });
});

/*Route Nhân viên*/
Route::prefix('auth/user')->middleware("auth:user")->name('user.')->group(function () {
    Route::get("/dashboard", [DashboardUserController::class, 'index'])->name('dashboard');

    /*Reader*/
    Route::prefix('/reader')->name('reader.')->group(function (){
        Route::get('/reader_code',[ReaderController::class,'index'])->name('barcode');
        Route::post('/reader_code',[ReaderController::class,'handleBarcode'])->name('handleBarcode');
    });

    /*Books*/
    Route::prefix('/book')->name('book.')->group(function (){
        Route::get('/book_list',[ReaderController::class,'bookList'])->name('bookList');
        Route::post('/barcode',[ReaderController::class,'bookBarcodes'])->name('bookBarcodes');
    });

     /*Return Books*/
    Route::prefix('/book-return')->name('return.')->group(function (){
        Route::get('/show-book',[ReaderController::class,'showBook'])->name('showBook');
        Route::post('/show-book',[ReaderController::class,'handleReturnBook'])->name('handleReturnBook');
    });

    /*Print*/
    Route::prefix('/print')->name('print.')->group(function (){
       Route::get('/bill-borrow',[InvoiceController::class,'bookBill'])->name('bookBill');
    });
});



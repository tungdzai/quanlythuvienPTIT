<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\Books\BooksRepositoryInterface;
use App\Repositories\Admin\Books\BooksRepository;
use App\Repositories\Admin\Users\UsersRepositoryInterface;
use App\Repositories\Admin\Users\UsersRepository;
use App\Repositories\Readers\ReadersRepositoryInterface;
use App\Repositories\Readers\ReadersRepository;
use App\Repositories\Borrowings\BorrowingsRepositoryInterface;
use App\Repositories\Borrowings\BorrowingsRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BooksRepositoryInterface::class,BooksRepository::class);
        $this->app->singleton(UsersRepositoryInterface::class,UsersRepository::class);
        $this->app->singleton(ReadersRepositoryInterface::class,ReadersRepository::class);
        $this->app->singleton(BorrowingsRepositoryInterface::class,BorrowingsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}

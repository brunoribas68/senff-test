<?php

namespace App\Providers;

use App\Models\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::model('id_request', Request::class);
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}

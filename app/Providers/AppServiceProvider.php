<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Kontak;
use Carbon\Carbon;

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
        /*
        |--------------------------------------------------------------------------
        | Pagination Bootstrap
        |--------------------------------------------------------------------------
        */
        Paginator::useBootstrapFive();

        /*
        |--------------------------------------------------------------------------
        | Locale Indonesia untuk Carbon
        |--------------------------------------------------------------------------
        */
        Carbon::setLocale('id');

        /*
        |--------------------------------------------------------------------------
        | Global View Composer
        |--------------------------------------------------------------------------
        */
        View::composer('*', function ($view) {

            $jumlahPesan = Kontak::count();

            $view->with(
                'jumlahPesan',
                $jumlahPesan
            );

        });
    }
}
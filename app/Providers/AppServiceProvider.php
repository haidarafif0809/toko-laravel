<?php

namespace App\Providers;

use App\KasMasuk;
use App\Observers\KasMasukObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        KasMasuk::observe(KasMasukObserver::class);
        // untuk menyesuaikan waktu berdasarkan tempat
        \Carbon\Carbon::setlocale('id');
        // jika ingin menesuaikan dengan locale di laravel
        // \Carbon\Carbon::setLocale(config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

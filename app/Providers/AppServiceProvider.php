<?php

namespace App\Providers;

use App\KasMasuk;
use App\Observers\KasMasukObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

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
        Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
            if (!empty($value) && !empty($parameters)) {
                $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];

                if (in_array($type, $parameters)) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        });

        Validator::replacer('image64', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':values', join(",", $parameters), $message);
        });

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

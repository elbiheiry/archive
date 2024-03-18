<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale(config('app.locale'));
        view()->share([
            'settings' => Setting::first()
        ]);
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

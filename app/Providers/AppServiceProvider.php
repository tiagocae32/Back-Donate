<?php

namespace App\Providers;

use App\Models\Campaña\Campaña;
use App\Observers\CampañaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Campaña::observe(CampañaObserver::class);
    }
}

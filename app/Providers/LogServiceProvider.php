<?php

namespace App\Providers;

use App\Log;
use App\Observers\LogObserver;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Log::observe(LogObserver::class);
    }
}

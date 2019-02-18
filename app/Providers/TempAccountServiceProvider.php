<?php

namespace App\Providers;

use App\TempAccount;
use App\Observers\TempAccountObserver;
use Illuminate\Support\ServiceProvider;

class TempAccountServiceProvider extends ServiceProvider
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
        TempAccount::observe(TempAccountObserver::class);
    }
}

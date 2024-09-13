<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\User;
use App\Observers\ClientObserver;
use App\Observers\UserObserver;
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
        Client::observe(ClientObserver::class);
        User::observe(UserObserver::class);
    }
}

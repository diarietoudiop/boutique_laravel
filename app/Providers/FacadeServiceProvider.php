<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\ClientServiceInterface;
use App\Services\Interfaces\ArticleServiceInterface;
use App\Services\Interfaces\DetteServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\QrCodeServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('clientService', function ($app) {
            return $app->make(ClientServiceInterface::class);
        });

        $this->app->singleton('articleService', function ($app) {
            return $app->make(ArticleServiceInterface::class);
        });

        $this->app->singleton('userService', function ($app) {
            return $app->make(UserServiceInterface::class);
        });
        $this->app->singleton('detteService', function ($app) {
            return $app->make(DetteServiceInterface::class);
        });

        $this->app->singleton('qrcodeService', function ($app) {
            return $app->make(QrCodeServiceInterface::class);
        });

        $this->app->singleton('roleService', function ($app) {
            return $app->make(RoleServiceInterface::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\ClientServiceInterface;
use App\Services\Interfaces\ArticleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\QrCodeServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\ArticleService;
use App\Services\ClientService;
use App\Services\DetteService;
use App\Services\Interfaces\DetteServiceInterface;
use App\Services\UserService;
use App\Services\QrCodeService;
use App\Services\RoleService;


class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
        $this->app->bind(DetteServiceInterface::class, DetteService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->singleton(QrCodeServiceInterface::class, function ($app) {
            return new QrCodeService();
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

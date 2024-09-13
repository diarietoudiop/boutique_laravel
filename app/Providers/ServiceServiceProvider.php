<?php

namespace App\Providers;

use App\Services\RoleService;
use App\Services\UserService;
use App\Services\DetteService;
use App\Services\ClientService;
use App\Services\QrCodeService;
use App\Services\ArticleService;
use Illuminate\Support\ServiceProvider;
use App\Services\CloudFileStorageService;
use App\Services\LocalFileStorageService;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\DetteServiceInterface;
use App\Services\Interfaces\ClientServiceInterface;
use App\Services\Interfaces\QrCodeServiceInterface;
use App\Services\Interfaces\ArticleServiceInterface;
use App\Services\Interfaces\CloudFileStorageServiceInterface;
use App\Services\Interfaces\LocalFileStorageServiceInterface;


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
        $this->app->bind(LocalFileStorageServiceInterface::class, LocalFileStorageService::class);
        $this->app->bind(CloudFileStorageServiceInterface::class, CloudFileStorageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

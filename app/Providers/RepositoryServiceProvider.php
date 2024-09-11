<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\ArticleRepository;
use App\Repository\Interfaces\ArticleRepositoryInterface;

use App\Repository\ClientRepository;
use App\Repository\Interfaces\ClientRepositoryInterface;

use App\Repository\UserRepository;
use App\Repository\Interfaces\UserRepositoryInterface;

use App\Repository\DetteRepository;
use App\Repository\Interfaces\DetteRepositoryInterface;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DetteRepositoryInterface::class, DetteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

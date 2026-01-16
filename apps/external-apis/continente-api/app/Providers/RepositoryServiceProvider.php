<?php

namespace App\Providers;

use App\Domain\Contracts\Repositories\ProductRepositoryInterface;
use App\Infra\Repository\Eloquent\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

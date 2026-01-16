<?php

namespace App\Providers;

use App\Domain\Contracts\Repositories\ProductRepositoryInterface;
use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;
use App\Infra\Repository\Eloquent\EloquentProductRepository;
use App\Infra\Repository\Eloquent\EloquentWebhookRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(WebhookRepositoryInterface::class, EloquentWebhookRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

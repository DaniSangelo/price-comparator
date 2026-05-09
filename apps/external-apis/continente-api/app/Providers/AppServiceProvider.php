<?php

namespace App\Providers;

use App\Application\UseCases\ProductUpdate\ProductUpdateUseCase;
use App\Application\UseCases\SearchProducts\SearchProductsUseCase;
use App\Domain\Contracts\EventPublisher;
use App\Domain\Contracts\HttpClientInterface;
use App\Infra\Http\Client\LaravelFacadeHttpClient;
use App\Infra\Messaging\RabbitMQEventPublisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SearchProductsUseCase::class);
        $this->app->singleton(ProductUpdateUseCase::class);
        $this->app->bind(EventPublisher::class, RabbitMQEventPublisher::class);
        $this->app->bind(HttpClientInterface::class, LaravelFacadeHttpClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::preventLazyLoading(!app()->isProduction());
    }
}

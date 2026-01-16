<?php

use App\Infra\Http\Controllers\ProductController;
use App\Infra\Http\Controllers\WebhookController;
use App\Infra\Http\Middleware\ApiKeyAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiKeyAuthMiddleware::class)->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/webhooks', [WebhookController::class, 'store']);
});

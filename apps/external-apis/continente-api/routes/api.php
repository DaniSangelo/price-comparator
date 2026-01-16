<?php

use App\Infra\Http\Controllers\ProductController;
use App\Infra\Http\Middleware\ApiKeyAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index'])->middleware(ApiKeyAuthMiddleware::class);

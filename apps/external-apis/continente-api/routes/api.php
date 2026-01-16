<?php

use App\Infra\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);

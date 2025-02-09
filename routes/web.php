<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home']);
Route::get('/product', [HomeController::class, 'product']);
Route::get('/products', [HomeController::class, 'products']);
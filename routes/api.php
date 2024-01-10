<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// for task1
Route::get('/products', [ProductController::class,'index']);

// for task 2

Route::apiResource('products', ProductController::class);

// for task 3

Route::get('/products/sorted', [ProductController::class, 'getSortedByPrice']);


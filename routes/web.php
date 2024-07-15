<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

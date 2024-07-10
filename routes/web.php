<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Define routes for displaying the HTML views
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('products', [ProductController::class, 'index'])->name('products.index');

// Add more routes as needed for displaying forms, etc.
// For example, routes for displaying create forms
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

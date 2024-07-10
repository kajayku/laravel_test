<?php

use App\Http\Controllers\API\CategoryController as APICategoryController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('categories', APICategoryController::class);
Route::apiResource('products', APIProductController::class);

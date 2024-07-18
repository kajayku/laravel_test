++++<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $data = Carbon::createFromFormat('d-m-Y', '13-05-1991')->format('Y-m-d');
    dd($data);
    return view('welcome');
});


Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');


Route::get('employee', [EmployeeController::class, 'create']);
Route::get('employeelist', [EmployeeController::class, 'index']);

Route::get('export-csv', [EmployeeController::class, 'exportCSV'])->name('export');
Route::post('import-csv', [EmployeeController::class, 'importCSV'])->name('import');
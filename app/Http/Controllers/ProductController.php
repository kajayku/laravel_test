<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // This returns the Blade view
        return view('products.index');
    }

    public function create()
    {
        // Return the view for creating a new product
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
}

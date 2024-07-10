<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // This returns the Blade view
        return view('categories.index');
    }

    public function create()
    {
        // Return the view for creating a new category
        return view('categories.create');
    }
}

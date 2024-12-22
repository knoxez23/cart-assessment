<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fetch all products
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products')); 
    }
}

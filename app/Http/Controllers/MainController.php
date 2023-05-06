<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function catalog()
    {
        $products = Product::get();
        return view('catalog', compact('products'));
    }

    public function product(Product $product)
    {
        return view('product', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('users.product', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('users.productdet', compact('product'));
    }
}
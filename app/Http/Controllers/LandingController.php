<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        return inertia('Landing/Inicio');
    }

    public function products()
    {
        $query = request('query');
        // $categories = Category::get('name');
        $products = Product::with('media')->get();

        return inertia('Landing/Products', compact('products', 'query'));
    }

    public function show(Product $product)
    {
        $product = $product->load('media');

        return inertia('Landing/Show', compact('product'));
    }
}

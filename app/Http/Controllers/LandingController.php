<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $category = request('category');
        $categories = Category::get(['id', 'name']);
        $products = Product::with(['media', 'category'])->get();

        return inertia('Landing/Products', compact('products', 'query', 'category', 'categories'));
    }

    public function show(Product $product)
    {
        $product = $product->load(['media', 'category']);

        return inertia('Landing/Show', compact('product'));
    }
}

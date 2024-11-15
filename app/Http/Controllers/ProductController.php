<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {   
        $products = Product::with('media')->get();

        // return $products;
        return inertia('Product/Index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return inertia('Product/Create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required',
        ]);

        $product = Product::create($validated);

        // Guardar el archivo en la colección 'image_cover1'
        if ($request->hasFile('image_cover1')) {
            $product->addMediaFromRequest('image_cover1')->toMediaCollection('cover1');
        }

        // Guardar el archivo en la colección 'image_cover2'
        if ($request->hasFile('image_cover2')) {
            $product->addMediaFromRequest('image_cover2')->toMediaCollection('cover2');
        }

        return to_route('products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {   
        $product->load('media');
        
        return inertia('Product/Edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        return 'eliminado';
    }

    public function getAll()
    {
        $items = Product::with(['media'])->get()->take(8);

        return response()->json(compact('items'));
    }
}

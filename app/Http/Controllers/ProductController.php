<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['media', 'category'])->paginate(30);
        $totalProducts = Product::all()->count();

        return inertia('Product/Index', compact('products', 'totalProducts'));
    }

    public function catalog()
    {
        $products = Product::with(['media', 'category:id,name'])->get();

        return inertia('Product/Catalog', compact('products'));
    }

    public function downloadPdf()
    {
        // Datos de ejemplo (debes reemplazarlos con los datos reales de tu aplicación)
        $products = Product::with('category', 'media')->get();
        $categories = $products->pluck('category.name')->unique();

        // Cargar la vista Blade y generar el PDF
        $pdf = Pdf::loadView('catalog', [
            'products' => $products,
            'categories' => $categories,
        ]);

        // Mostrar el PDF en el navegador
        // return $pdf->stream('Catalogo_Aceros_Soluciones.pdf');

        // Descargar el PDF
        return $pdf->download('Catalogo_Aceros_Soluciones.pdf');
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
            'description' => 'nullable|string|max:800',
            'category_id' => 'required',
            'is_popular' => 'boolean',
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

        // Guardar el archivo en la colección 'image_cover3'
        if ($request->hasFile('image_cover3')) {
            $product->addMediaFromRequest('image_cover3')->toMediaCollection('cover3');
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
        $categories = Category::all();

        return inertia('Product/Edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:800',
            'category_id' => 'required',
            'is_popular' => 'boolean',
        ]);

        $product->update($validated);

        // Eliminar imágenes antiguas solo si se borró desde el input y no se agregó una nueva
        if ($request->clearedCover1) {
            $product->clearMediaCollection('cover1');
        }

        if ($request->clearedCover2) {
            $product->clearMediaCollection('cover2');
        }

        if ($request->clearedCover2) {
            $product->clearMediaCollection('cover3');
        }

        return to_route('products.index');
    }


    public function updateWithMedia(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:800',
            'category_id' => 'required',
            'is_popular' => 'boolean',
        ]);

        $product->update($validated);

        // update image ---------------------------------------------------------------------

        // Eliminar imágenes antiguas solo si se borró desde el input y no se agregó una nueva
        if ($request->clearedCover1) {
            $product->clearMediaCollection('cover1');
        }

        if ($request->clearedCover2) {
            $product->clearMediaCollection('cover2');
        }

        if ($request->clearedCover3) {
            $product->clearMediaCollection('cover3');
        }

        // Eliminar imágenes antiguas solo si se proporcionan nuevas imágenes
        if ($request->hasFile('image_cover1')) {
            $product->clearMediaCollection('cover1');
        }

        if ($request->hasFile('image_cover2')) {
            $product->clearMediaCollection('cover2');
        }

        if ($request->hasFile('image_cover3')) {
            $product->clearMediaCollection('cover3');
        }

        // Guardar el archivo en la colección 'image_cover1'
        if ($request->hasFile('image_cover1')) {
            $product->addMediaFromRequest('image_cover1')->toMediaCollection('cover1');
        }

        // Guardar el archivo en la colección 'image_cover2'
        if ($request->hasFile('image_cover2')) {
            $product->addMediaFromRequest('image_cover2')->toMediaCollection('cover2');
        }

        // Guardar el archivo en la colección 'image_cover3'
        if ($request->hasFile('image_cover3')) {
            $product->addMediaFromRequest('image_cover3')->toMediaCollection('cover3');
        }

        return to_route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function getMatches(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda
        $products = Product::with(['media', 'category'])->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->paginate(50);

        // Devuelve los items encontrados
        return response()->json(['items' => $products], 200);
    }

    public function getPopular()
    {
        $items = Product::with(['media', 'category'])->where('is_popular', true)->get();

        return response()->json(compact('items'));
    }
}

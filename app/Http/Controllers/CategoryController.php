<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = Category::all();

        return inertia('Category/Index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250|unique:categories'
        ]);

        Category::create($request->all());
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:250',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category->update($request->only('name'));
    }

    public function destroy(Category $category)
    {
        //
    }

    public function massiveDelete(Request $request)
    {
        foreach ($request->categories as $category) {
            $category = Category::find($category['id']);
            $category?->delete();

        }

        return response()->json(['message' => 'Categoría(s) eliminada(s)']);
    }
}

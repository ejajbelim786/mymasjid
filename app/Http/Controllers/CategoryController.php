<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category,SubCategory};

class CategoryController extends Controller
{
    // Show Categories Page
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        return view('backend.accounting.category.index', compact('categories'));
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }
    

    // Store a New Category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'subcategories.*' => 'required'
        ]);

        $category = Category::create(['name' => $request->name]);

        if ($request->has('subcategories')) {
            foreach ($request->subcategories as $subcat) {
                SubCategory::create([
                    'name' => $subcat,
                    'category_id' => $category->id
                ]);
            }
        }

        return response()->json(['success' => 'Category and subcategories added successfully!']);
    }

    // Get Category Details for Edit
    public function edit($id)
    {
        $category = Category::with('subcategories')->find($id);
        return response()->json($category);
    }

    // Update Category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        // Update subcategories
        $category->subcategories()->delete(); // Remove old subcategories
        if ($request->subcategories) {
            foreach ($request->subcategories as $sub) {
                $category->subcategories()->create(['name' => $sub]);
            }
        }

        return response()->json(['success' => 'Category updated successfully!']);
    }

    // Delete Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully!']);
    }
}

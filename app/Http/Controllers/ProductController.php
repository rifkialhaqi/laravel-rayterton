<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = \App\Models\Category::all(); // Assuming you have a Category model
        return view('products.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'sku' => 'required|string|max:100|unique:products',
            'name' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            $product = Product::findOrFail($id); // Fetch the product by ID
        //
        $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'name' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
     //

}

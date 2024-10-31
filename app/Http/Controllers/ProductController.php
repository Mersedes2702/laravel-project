<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply search filter by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply price range filter
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Get filtered products
        $products = $query->get();

        // Get all unique categories for filter dropdown
        $categories = Product::select('category')->distinct()->pluck('category');

        // Return the view and pass the products and categories data
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        // Return the view for creating a new product
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'ean' => 'required|unique:products,ean',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $data['image'] = $imagePath;
    }

        Product::create($data);

        Log::create([
            'action' => 'created',
            'product_id' => $product->id,
            'user_id' => Auth::id(),
        ]);
        // Redirect back to the product listing page
        return redirect('/products')->with('success', 'Product added successfully!');
    }

    public function show($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Return the product detail view
        return view('products.show', compact('product'));
    }
    public function edit($id)
{
    // Fetch the product by its ID
    $product = Product::findOrFail($id);

    // Return the edit view with the product data
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    // Validate the input data
    $request->validate([
        'ean' => 'required|unique:products,ean,' . $id,
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'required|string|max:255',
    ]);

    // Update the product in the database
    $product = Product::findOrFail($id);
    $product->update($request->all());

    Log::create([
        'action' => 'updated',
        'product_id' => $product->id,
        'user_id' => Auth::id(),
    ]);

    // Redirect back to the product listing page
    return redirect('/products')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    // Find and delete the product
    $product = Product::findOrFail($id);
    
    Log::create([
        'action' => 'deleted',
        'product_id' => $product->id,
        'user_id' => Auth::id(),
    ]);

    $product->delete();

    // Redirect back to the product listing page
    return redirect('/products')->with('success', 'Product deleted successfully!');
}

}


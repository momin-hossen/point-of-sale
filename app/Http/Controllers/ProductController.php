<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index',[
            'products' => Product::when(request('search'), function($q) {
                $q->where('name', 'like', '%'.request('search').'%');
            })
            ->latest()
            ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create', [
            'active_categories' => Category::all(),
            'products' => Product::with('onetoonerelationwithcategorytable')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Assuming you have a categories table
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB file size
            'price' => 'required|numeric|min:0',
            'discount_type' => 'required',
            'discount_amount' => 'required_if:discount_type,amount|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('product'), $imageName);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_type = $request->discount_type;
        $product->discount_amount = $request->discount_amount;
        $product->sale_price = $request->sale_price;
        $product->image = $imageName;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $active_categories = Category::all();
        $product_info = $product;

        return view('admin.products.edit', compact('product', 'active_categories', 'product_info'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Assuming you have a categories table
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB file size
            'price' => 'required|numeric|min:0',
            'discount_type' => 'required',
            'discount_amount' => 'required_if:discount_type,amount|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);


        $product = Product::findOrFail($id);

        // Update product data
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_type = $request->discount_type;
        $product->discount_amount = $request->discount_amount;
        $product->sale_price = $request->sale_price;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('product') . '/' . $product->image)) {
                unlink(public_path('product') . '/' . $product->image);
            }

            // Upload and save the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('product'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                     ->with('success', 'Product deleted successfully');
    }
}

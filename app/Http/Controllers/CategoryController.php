<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB file size
            'status' => 'required|in:active,inactive',
            'description' => 'required',
        ]);

        // upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('category'), $imageName);

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->image = $imageName;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB file size
            'status' => 'required|in:active,inactive',
            'description' => 'required',
        ]);

        $category = Category::findOrFail($id);

        // Update category data
        $category->name = $request->name;
        $category->status = $request->status;
        $category->description = $request->description;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (public_path('category') . '/' . $category->image && file_exists(public_path('category') . '/' . $category->image)) {
                unlink(public_path('category') . '/' . $category->image);
            }

            // Upload and save the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('category'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
    $category->delete();

    return redirect()->route('categories.index')
                     ->with('success', 'Category deleted successfully');
    }
}

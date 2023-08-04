<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_categories = ExpenseCategory::all();
        return view('admin.ExpenseCategories.index', compact('expense_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ExpenseCategories.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);
    
        ExpenseCategory::create($request->all());
    
        return redirect()->route('expense_categories.index')
                         ->with('success', 'Expense Category created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return view('expense_categories.show', compact('expenseCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('admin.ExpenseCategories.edit', compact('expenseCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->all());
        return redirect()->route('expense_categories.index')->with('success', 'Expense Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        return redirect()->route('expense_categories.index')->with('success', 'Expense Category deleted successfully.');
    }
}

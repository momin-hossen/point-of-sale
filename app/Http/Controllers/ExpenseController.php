<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $active_expense_categories = ExpenseCategory::all();
        $expenses = Expense::all();
        return view('admin.expense.index', compact('expenses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expense.create', [
            'active_expense_categories' => ExpenseCategory::all(),
            'expenses' => Expense::with('onetoonerelationwithexpensecategorytable')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'expense_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);
        Expense::create([
            'expense_date' => $request->expense_date,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'expense_category_id' => $request->expense_category_id,
        ]);
    
        return redirect()->route('expenses.index')
                         ->with('success', 'Unit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $active_expense_categories = ExpenseCategory::all();
        $expense_info = $expense;
        return view('admin.expense.edit', compact('expense', 'active_expense_categories', 'expense_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->update([
            'expense_date' => $request->expense_date,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'expense_category_id' => $request->expense_category_id,
        ]);
        return redirect()->route('expenses.index')
                         ->with('success', ' created successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense_categories.index')->with('success', 'Expense deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sales.index',[
            'sales' => Sale::when(request('search'), function($q) {
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
        return view('admin.sales.create', [
            'active_products' => Product::all(),
            'sales' => Sale::with('onetoonerelationwithproducttable')->get(),
            'active_customers' => Customer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'discount_type' => 'required',
            'sale_price' => 'required|numeric|min:0',
            'total_bill' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
        ]);


        $customer = Customer::findOrFail($request->customer_id);
        $customer->update([
            'total_bill' => $customer->total_bill + $request->total_bill,
            'due_amount' => $customer->due_amount + $request->due_amount,
            'paid_amount' => $customer->paid_amount + $request->paid_amount,
        ]);

        Sale::create($validatedData);

        return redirect()->route('sales.index')
                         ->with('success', 'Sale created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $active_products = Product::all();
        $sale_info = $sale;
        $active_customers = Customer::all();

        return view('admin.sales.edit', compact('sale', 'active_products', 'sale_info', 'active_customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'discount_type' => 'required',
            'sale_price' => 'required|numeric',
            'total_bill' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);

        $sale->update($validatedData);
        return redirect()->route('sales.index')->with('success', 'Sales updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}

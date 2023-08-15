<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.purchases.index',[
            'purchases' => Purchase::when(request('search'), function($q) {
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
        return view('admin.purchases.create', [
            'active_products' => Product::all(),
            'purchases' => Purchase::with('onetoonerelationwithproducttable')->get(),
            'active_suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'discount_type' => 'required',
            'sale_price' => 'required|numeric|min:0',
            'total_bill' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
        ]);


        $supplier = Supplier::findOrFail($request->supplier_id);
        $supplier->update([
            'total_bill' => $supplier->total_bill + $request->total_bill,
            'due_amount' => $supplier->due_amount + $request->due_amount,
            'paid_amount' => $supplier->paid_amount + $request->paid_amount,
        ]);


        // Purchase::create($request->all());
        Purchase::create($validatedData);

        return redirect()->route('purchases.index')
                         ->with('success', 'Purchase created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $active_products = Product::all();
        $purchase_info = $purchase;
        $active_suppliers = Supplier::all();

        return view('admin.purchases.edit', compact('purchase', 'active_products', 'purchase_info', 'active_suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {

        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'discount_type' => 'required',
            'sale_price' => 'required|numeric',
            'total_bill' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);

        $purchase->update($validatedData);
        // $purchase->update($request->all());
        return redirect()->route('purchases.index')->with('success', 'Purchases updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'purchase deleted successfully.');
    }
}

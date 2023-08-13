<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\SupplierModule;
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
            'active_suppliers' => SupplierModule::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = SupplierModule::findOrFail($request->supplier_id);
        $supplier->update([
            'total_bill' => $supplier->total_bill + $request->total_bill,
            'due_amount' => $supplier->due_amount + $request->due_amount,
            'pay_amount' => $supplier->pay_amount + $request->pay_amount,
        ]);
        Purchase::create($request->all());

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
        $active_suppliers = SupplierModule::all();

        return view('admin.purchases.edit', compact('purchase', 'active_products', 'purchase_info', 'active_suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
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

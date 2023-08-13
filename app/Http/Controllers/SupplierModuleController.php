<?php

namespace App\Http\Controllers;

use App\Models\SupplierModule;
use Illuminate\Http\Request;

class SupplierModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier_modules = SupplierModule::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->get();
        return view('admin.supplier_modules.index', compact('supplier_modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier_modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SupplierModule::create($request->all());

        return redirect()->route('supplier_modules.index')
                         ->with('success', 'Supplier Module created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierModule $supplierModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierModule $supplierModule)
    {
        return view('admin.supplier_modules.edit', compact('supplierModule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierModule $supplierModule)
    {
        $supplierModule->update($request->all());
        return redirect()->route('supplier_modules.index')->with('success', 'Supplier Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierModule $supplierModule)
    {
        $supplierModule->delete();
        return redirect()->route('supplier_modules.index')->with('success', 'Supplier Module deleted successfully.');
    }
}

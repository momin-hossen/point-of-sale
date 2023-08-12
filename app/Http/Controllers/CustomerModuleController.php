<?php

namespace App\Http\Controllers;

use App\Models\CustomerModule;
use Illuminate\Http\Request;

class CustomerModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_modules = CustomerModule::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->get();
        return view('admin.customer_modules.index', compact('customer_modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer_modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CustomerModule::create($request->all());

        return redirect()->route('customer_modules.index')
                         ->with('success', 'Customer Module created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerModule $customerModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerModule $customerModule)
    {
        return view('admin.customer_modules.edit', compact('customerModule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerModule $customerModule)
    {
        $customerModule->update($request->all());
        return redirect()->route('customer_modules.index')->with('success', 'Customer Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerModule $customerModule)
    {
        $customerModule->delete();
        return redirect()->route('customer_modules.index')->with('success', 'Customer Module deleted successfully.');
    }
}

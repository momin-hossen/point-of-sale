<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $units = Unit::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->get();
        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:active,inactive',
            'description' => 'required',
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')
                         ->with('success', 'Unit created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:active,inactive',
            'description' => 'required',
        ]);

        $unit->update($request->all());
        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\Level;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('admin.structure');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'level_id' => 'required|exists:levels,id',
        ]);
        
        Year::create($request->only('name', 'level_id'));
        return back()->with('success', 'Year added successfully');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
         $year->delete();
        return back()->with('success', 'Year deleted successfully');
    }
}

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->only('name', 'level_id');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/years'), $imageName);
            $data['image'] = 'images/years/' . $imageName;
        }
        
        Year::create($data);
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
    public function edit(Year $year)
    {
        $levels = Level::all();
        return view('admin.years.edit', compact('year', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {
        $request->validate([
            'name' => 'required|string',
            'level_id' => 'required|exists:levels,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->only('name', 'level_id');
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($year->image && file_exists(public_path($year->image))) {
                unlink(public_path($year->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/years'), $imageName);
            $data['image'] = 'images/years/' . $imageName;
        }
        
        $year->update($data);
        return redirect()->route('admin.structure')->with('success', 'Year updated successfully');
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

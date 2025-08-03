<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;

class SubjectController extends Controller
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
            'year_id' => 'required|exists:years,id',
            'field_id' => 'nullable|exists:fields,id',
        ]);
        
        Subject::create($request->only('name', 'level_id', 'year_id', 'field_id'));
        return back()->with('success', 'Matière ajoutée avec succès');
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
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with('success', 'Matière supprimée avec succès');
    }

    /**
     * Get years by level for AJAX requests
     */
    public function getYearsByLevel($levelId)
    {
        $years = Year::where('level_id', $levelId)->get();
        return response()->json($years);
    }

    /**
     * Get fields by year for AJAX requests
     */
    public function getFieldsByYear($yearId)
    {
        $fields = Field::where('year_id', $yearId)->get();
        return response()->json($fields);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::where('created_by', Auth::id())->get();
        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('teacher.materials.create');
    }

    public function store(Request $request)
    {
        // Add validation and store logic here
    }

    public function edit(StudyMaterial $material)
    {
        return view('teacher.materials.edit', compact('material'));
    }

    public function update(Request $request, StudyMaterial $material)
    {
        // Add validation and update logic here
    }

    public function destroy(StudyMaterial $material)
    {
        // Add delete logic here
    }
}

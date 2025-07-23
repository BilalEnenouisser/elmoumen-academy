<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::where('user_id', auth()->id())
            ->with(['level', 'year', 'field'])
            ->latest()
            ->paginate(10);

        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('teacher.materials.create', [
            'levels' => Level::all(),
            'years' => Year::all(),
            'fields' => Field::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|in:Cours,Séries,Autres',
            'pdf_path'   => 'nullable|file|mimes:pdf|max:10240',
            'video_url'  => 'nullable|url',
            'thumbnail'  => 'nullable|url',
            'level_id'   => 'required|exists:levels,id',
            'year_id'    => 'nullable|exists:years,id',
            'field_id'   => 'nullable|exists:fields,id',
        ]);

        $data = $request->except('pdf_path');

        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('pdfs', 'public');
        }

        $data['user_id'] = auth()->id();

        Material::create($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Matériel ajouté avec succès.');
    }

    public function edit(Material $material)
    {
        if ($material->user_id !== auth()->id()) {
            abort(403); // Forbidden
        }

        return view('teacher.materials.edit', [
            'material' => $material,
            'levels' => Level::all(),
            'years' => Year::all(),
            'fields' => Field::all(),
        ]);
    }

    public function update(Request $request, Material $material)
    {
        if ($material->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|in:Cours,Séries,Autres',
            'pdf_path'   => 'nullable|file|mimes:pdf|max:10240',
            'video_url'  => 'nullable|url',
            'thumbnail'  => 'nullable|url',
            'level_id'   => 'required|exists:levels,id',
            'year_id'    => 'nullable|exists:years,id',
            'field_id'   => 'nullable|exists:fields,id',
        ]);

        $data = $request->except('pdf_path');

        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('pdfs', 'public');
        }

        $material->update($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Matériel mis à jour.');
    }

    public function destroy(Material $material)
    {
        if ($material->user_id !== auth()->id()) {
            abort(403);
        }

        $material->delete();

        return redirect()->route('teacher.materials.index')->with('success', 'Matériel supprimé.');
    }
}

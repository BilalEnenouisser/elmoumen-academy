<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('display_order')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|min:6',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_order' => 'integer|min:0',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');
        $data['show_in_about'] = $request->has('show_in_about');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('teachers', 'public');
            $data['image_path'] = $imagePath;
        }

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'nullable|min:6',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_order' => 'integer|min:0',
        ]);

        $data = $request->except(['image', 'password']);
        $data['is_active'] = $request->has('is_active');
        $data['show_in_about'] = $request->has('show_in_about');

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teacher->image_path) {
                Storage::disk('public')->delete($teacher->image_path);
            }
            $imagePath = $request->file('image')->store('teachers', 'public');
            $data['image_path'] = $imagePath;
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Teacher $teacher)
    {
        // Delete image if exists
        if ($teacher->image_path) {
            Storage::disk('public')->delete($teacher->image_path);
        }
        
        $teacher->delete();
        return back()->with('success', 'Enseignant supprimé avec succès.');
    }

    public function toggleStatus(Teacher $teacher)
    {
        $teacher->update(['is_active' => !$teacher->is_active]);
        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function toggleShowInAbout(Teacher $teacher)
    {
        $teacher->update(['show_in_about' => !$teacher->show_in_about]);
        return back()->with('success', 'Affichage dans la page À propos mis à jour avec succès.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::withCount('books')->orderBy('name')->get();
        return view('admin.books.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:book_categories',
            'description' => 'nullable|string'
        ]);

        BookCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return redirect()->route('admin.books.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function update(Request $request, BookCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:book_categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return redirect()->route('admin.books.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(BookCategory $category)
    {
        if ($category->books()->count() > 0) {
            return redirect()->route('admin.books.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des livres.');
        }

        $category->delete();

        return redirect()->route('admin.books.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = BookCategory::orderBy('name')->get();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = BookCategory::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'reduced_price' => 'nullable|numeric|min:0|lt:price',
            'category_id' => 'required|exists:book_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'reduced_price' => $request->reduced_price,
            'category_id' => $request->category_id,
            'is_active' => $request->has('is_active')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image_path'] = $imagePath;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre ajouté avec succès.');
    }

    public function edit(Book $book)
    {
        $categories = BookCategory::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'reduced_price' => 'nullable|numeric|min:0|lt:price',
            'category_id' => 'required|exists:book_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'reduced_price' => $request->reduced_price,
            'category_id' => $request->category_id,
            'is_active' => $request->has('is_active')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($book->image_path) {
                Storage::disk('public')->delete($book->image_path);
            }
            
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image_path'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(Book $book)
    {
        // Delete image
        if ($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre supprimé avec succès.');
    }
} 
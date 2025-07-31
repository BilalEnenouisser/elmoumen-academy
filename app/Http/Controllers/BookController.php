<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')->active();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

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

        $books = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = BookCategory::withCount('books')->orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        if (!$book->is_active) {
            abort(404);
        }

        $relatedBooks = Book::with('category')
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->active()
            ->limit(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    public function category(BookCategory $category)
    {
        $books = Book::with('category')
            ->where('category_id', $category->id)
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('books.category', compact('category', 'books'));
    }

    public function getFeaturedBooks()
    {
        // Get books with discounts first, then recent books
        $featuredBooks = Book::with('category')
            ->active()
            ->orderByRaw('CASE WHEN reduced_price IS NOT NULL AND reduced_price < price THEN 1 ELSE 2 END')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return $featuredBooks;
    }
} 
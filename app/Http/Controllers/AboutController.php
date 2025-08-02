<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\WhatsAppNumber;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get featured books for the about page
        $books = Book::with('category')
            ->where('is_active', true)
            ->orderByRaw('CASE WHEN reduced_price IS NOT NULL AND reduced_price < price THEN 1 ELSE 2 END')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        // Get WhatsApp number
        $whatsappNumber = WhatsAppNumber::getActiveNumber();

        return view('about', compact('books', 'whatsappNumber'));
    }
} 
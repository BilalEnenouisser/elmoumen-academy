<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookClick;
use Illuminate\Http\Request;

class BookClickController extends Controller
{
    public function track(Request $request, $bookId)
    {
        \Log::info('Book click tracking request received', [
            'book_id' => $bookId,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        $book = Book::findOrFail($bookId);
        
        // Record the click
        $click = BookClick::recordClick($bookId);
        
        \Log::info('Book click recorded', [
            'click_id' => $click->id,
            'book_id' => $bookId
        ]);
        
        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Click recorded successfully',
            'clicks_count' => $book->clicks_count,
            'book_id' => $bookId
        ]);
    }

    public function getStats()
    {
        $stats = [
            'total_clicks' => BookClick::getTotalClicks(),
            'clicks_today' => BookClick::getClicksToday(),
            'clicks_this_week' => BookClick::getClicksThisWeek(),
            'clicks_this_month' => BookClick::getClicksThisMonth(),
            'top_books' => BookClick::getTopBooks(5),
            'total_books' => Book::count(),
            'books_with_clicks' => Book::whereHas('clicks')->count()
        ];

        return response()->json($stats);
    }
}

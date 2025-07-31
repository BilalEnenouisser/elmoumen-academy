<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function recordClick($bookId)
    {
        return static::create([
            'book_id' => $bookId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    public static function getTotalClicks()
    {
        return static::count();
    }

    public static function getClicksForBook($bookId)
    {
        return static::where('book_id', $bookId)->count();
    }

    public static function getTopBooks($limit = 10)
    {
        return static::selectRaw('book_id, COUNT(*) as click_count')
            ->with('book:id,name,slug')
            ->groupBy('book_id')
            ->orderByDesc('click_count')
            ->limit($limit)
            ->get();
    }

    public static function getClicksToday()
    {
        return static::whereDate('created_at', today())->count();
    }

    public static function getClicksThisWeek()
    {
        return static::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    }

    public static function getClicksThisMonth()
    {
        return static::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }
}

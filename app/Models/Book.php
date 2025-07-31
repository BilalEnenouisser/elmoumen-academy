<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'reduced_price',
        'image_path',
        'category_id',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'reduced_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }

    public function clicks()
    {
        return $this->hasMany(BookClick::class);
    }

    public function getClicksCountAttribute()
    {
        return $this->clicks()->count();
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->reduced_price && $this->price > 0) {
            return round((($this->price - $this->reduced_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getFinalPriceAttribute()
    {
        return $this->reduced_price ?? $this->price;
    }

    public function getHasDiscountAttribute()
    {
        return $this->reduced_price && $this->reduced_price < $this->price;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithDiscount($query)
    {
        return $query->whereNotNull('reduced_price')
                    ->where('reduced_price', '<', 'price');
    }
} 
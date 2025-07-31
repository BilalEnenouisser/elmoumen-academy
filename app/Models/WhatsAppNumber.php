<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function getActiveNumber()
    {
        return static::where('is_active', true)->first();
    }

    public function getFormattedNumberAttribute()
    {
        // Remove any non-digit characters and ensure it starts with country code
        $number = preg_replace('/[^0-9]/', '', $this->phone_number);
        
        // If it doesn't start with country code, assume it's Moroccan (+212)
        if (!str_starts_with($number, '212')) {
            $number = '212' . ltrim($number, '0');
        }
        
        return $number;
    }

    public function getWhatsAppUrlAttribute()
    {
        return "https://wa.me/{$this->formatted_number}";
    }
}

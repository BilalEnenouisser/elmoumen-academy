<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'description',
        'image_path',
        'is_active',
        'show_in_about',
        'display_order',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'show_in_about' => 'boolean',
    ];

    /**
     * Get the first letter of the teacher's name for avatar display
     */
    public function getFirstLetterAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    /**
     * Get a color for the teacher's avatar background
     */
    public function getAvatarColorAttribute()
    {
        $colors = [
            'background-color: #3b82f6;', // blue-500
            'background-color: #10b981;', // green-500
            'background-color: #8b5cf6;', // purple-500
            'background-color: #eab308;', // yellow-500
            'background-color: #ef4444;', // red-500
            'background-color: #6366f1;', // indigo-500
            'background-color: #14b8a6;', // teal-500
            'background-color: #ec4899;', // pink-500
            'background-color: #06b6d4;', // cyan-500
            'background-color: #f97316;', // orange-500
            'background-color: #059669;', // emerald-500
            'background-color: #f43f5e;', // rose-500
        ];
        
        // Use a combination of name and ID for better distribution
        $hash = crc32($this->name . $this->id);
        $index = $hash % count($colors);
        return $colors[$index];
    }

    /**
     * Scope to get only active teachers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get teachers that should be shown in about page
     */
    public function scopeShowInAbout($query)
    {
        return $query->where('show_in_about', true)->where('is_active', true);
    }

    /**
     * Set password with hashing
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}

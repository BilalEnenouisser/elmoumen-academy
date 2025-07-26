<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function videos()
    {
        return $this->hasMany(CategoryVideo::class)->orderBy('order');
    }

    public function activeVideos()
    {
        return $this->hasMany(CategoryVideo::class)->where('is_active', true)->orderBy('order');
    }
} 
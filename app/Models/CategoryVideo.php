<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_category_id',
        'title',
        'description',
        'video_link',
        'thumbnail_path',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(VideoCategory::class, 'video_category_id');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            return asset('storage/' . $this->thumbnail_path);
        }
        
        // Extract YouTube video ID and generate thumbnail
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $this->video_link, $matches)) {
            $videoId = $matches[1];
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }
        
        return asset('images/default-video-thumbnail.jpg');
    }
    
    public function clicks()
    {
        return $this->hasMany(VideoClick::class);
    }
} 
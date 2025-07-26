<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_video_id',
        'user_id',
        'ip_address',
        'user_agent'
    ];

    public function categoryVideo()
    {
        return $this->belongsTo(CategoryVideo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

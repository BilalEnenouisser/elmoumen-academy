<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialVideoClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_video_id',
        'user_id',
        'ip_address',
        'user_agent',
    ];

    public function materialVideo()
    {
        return $this->belongsTo(MaterialVideo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



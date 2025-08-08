<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_block_id',
        'video_link',
        'title'
    ];

    public function materialBlock()
    {
        return $this->belongsTo(MaterialBlock::class);
    }

    public function studyMaterial()
    {
        return $this->hasOneThrough(StudyMaterial::class, MaterialBlock::class);
    }

    public function clicks()
    {
        return $this->hasMany(\App\Models\MaterialVideoClick::class);
    }
} 
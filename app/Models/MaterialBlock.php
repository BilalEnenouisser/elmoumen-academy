<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_material_id',
        'type',
        'semester',
        'material_type',
        'exam_type',
        'order'
    ];

    public function studyMaterial()
    {
        return $this->belongsTo(StudyMaterial::class);
    }

    public function pdfs()
    {
        return $this->hasMany(MaterialPdf::class);
    }

    public function videos()
    {
        return $this->hasMany(MaterialVideo::class);
    }
} 
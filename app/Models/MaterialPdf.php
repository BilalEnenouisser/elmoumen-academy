<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_block_id',
        'pdf_path',
        'title',
        'teacher_id'
    ];

    public function materialBlock()
    {
        return $this->belongsTo(MaterialBlock::class);
    }

    public function studyMaterial()
    {
        return $this->hasOneThrough(StudyMaterial::class, MaterialBlock::class);
    }
    
    public function downloads()
    {
        return $this->hasMany(PdfDownload::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
} 
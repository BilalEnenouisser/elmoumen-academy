<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'level_id', 'year_id', 'field_id', 'subject_id',
        'title'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function blocks()
    {
        return $this->hasMany(MaterialBlock::class)->orderBy('order');
    }

    public function pdfs()
    {
        return $this->hasManyThrough(MaterialPdf::class, MaterialBlock::class);
    }

    public function videos()
    {
        return $this->hasManyThrough(MaterialVideo::class, MaterialBlock::class);
    }
}

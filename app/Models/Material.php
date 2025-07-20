<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'pdf_path', 'video_url', 'thumbnail',
        'level_id', 'year_id', 'field_id', 'subject_id', 'user_id'
    ];

    public function level()  { return $this->belongsTo(Level::class); }
    public function year()   { return $this->belongsTo(Year::class); }
    public function field()  { return $this->belongsTo(Field::class); }
    public function subject(){ return $this->belongsTo(Subject::class); }
    public function user()   { return $this->belongsTo(User::class); }
}

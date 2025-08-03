<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'level_id', 'year_id', 'field_id'];

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

    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }

    protected static function booted()
    {
        static::creating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });

        static::updating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

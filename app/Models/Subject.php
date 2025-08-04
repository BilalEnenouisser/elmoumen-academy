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
            $subject->slug = $subject->generateUniqueSlug();
        });

        static::updating(function ($subject) {
            $subject->slug = $subject->generateUniqueSlug();
        });
    }

    public function generateUniqueSlug()
    {
        $baseSlug = Str::slug($this->name);
        $level = $this->level ? Str::slug($this->level->name) : '';
        $year = $this->year ? Str::slug($this->year->name) : '';
        $field = $this->field ? Str::slug($this->field->name) : '';
        
        // Create a unique slug combining name, level, year, and field
        $slug = $baseSlug;
        if ($level) {
            $slug .= '-' . $level;
        }
        if ($year) {
            $slug .= '-' . $year;
        }
        if ($field) {
            $slug .= '-' . $field;
        }
        
        // Check if this slug already exists
        $originalSlug = $slug;
        $counter = 1;
        
        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

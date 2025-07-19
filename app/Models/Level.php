<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function years()
    {
        return $this->hasMany(Year::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }
}

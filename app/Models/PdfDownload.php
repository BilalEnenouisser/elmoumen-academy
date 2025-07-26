<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_pdf_id',
        'user_id',
        'ip_address',
        'user_agent'
    ];

    public function materialPdf()
    {
        return $this->belongsTo(MaterialPdf::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

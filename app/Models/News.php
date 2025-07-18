<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Tambahkan ini
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory; // 2. Tambahkan ini

    protected $fillable = [
        'title',
        'thumbnail',
        'content',
        'slug',
        'images'
    ];
    
    // 3. Tambahkan $casts agar Laravel tahu 'images' adalah array
    protected $casts = [
        'images' => 'array',
    ];

    // Accessor Anda untuk thumbnail URL sudah bagus, tidak perlu diubah
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'category_id',
        'user_id',
    ];

    // Satu post milik satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Satu post ditulis oleh satu user (author)
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
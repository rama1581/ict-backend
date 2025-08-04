<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class SlideshowImage extends Model
{
    protected $fillable = ['image_path', 'is_active'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Guide extends Model
{
     protected $fillable = [
        'title',
        'link',
        'category',
        'icon',
    ];
}

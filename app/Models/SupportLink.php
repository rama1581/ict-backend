<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class SupportLink extends Model
{
    protected $fillable = ['icon', 'title', 'description', 'link'];
}

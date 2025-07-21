<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // 👇 PASTIKAN BLOK INI ADA
    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'status',
    ];
}
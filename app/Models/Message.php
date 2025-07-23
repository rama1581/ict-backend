<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'status', 'user_id', 'message', 'is_admin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

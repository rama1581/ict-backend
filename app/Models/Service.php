<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['icon','title', 'description', 'link']; // ✅ tambahkan kolom-kolom yang bisa diisi

    public function statusLogs()
    {
        return $this->hasMany(ServiceStatusLog::class)->latest('logged_at');
    }
}

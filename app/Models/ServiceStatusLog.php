<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_status_id',
        'description',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function serviceStatus()
    {
        return $this->belongsTo(ServiceStatus::class);
    }
}

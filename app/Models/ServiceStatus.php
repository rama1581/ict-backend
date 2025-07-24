<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // 👇 TAMBAHKAN PROPERTI INI
    protected $fillable = [
        'name',
        'status',
        'description',
    ];

    public function logs()
    {
        return $this->hasMany(ServiceStatusLog::class, 'service_status_id');
    }
}
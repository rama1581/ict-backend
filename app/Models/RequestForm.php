<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RequestForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'ticket_code',
        'status',
    ];

    /**
     * Boot method to hook into model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($request) {
            if (empty($request->ticket_code)) {
                $request->ticket_code = strtoupper(Str::random(8)); // Contoh: AB12CD34
            }
        });
    }

    public function progresses()
    {
    return $this->hasMany(TicketProgress::class, 'ticket_id', 'id');
    }

}

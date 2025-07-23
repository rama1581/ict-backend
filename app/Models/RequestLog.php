<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'request_form_id',
        'message',
    ];

    /**
     * Get the request form that owns the log.
     */
    public function requestForm()
    {
        return $this->belongsTo(RequestForm::class);
    }
}

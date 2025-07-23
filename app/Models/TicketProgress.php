<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketProgress extends Model
{

    protected $table = 'ticket_progresses';

    protected $fillable = ['ticket_id', 'request_form_id', 'note', 'status'];


    public function requestForm(): BelongsTo
    {
        return $this->belongsTo(RequestForm::class, 'ticket_id');
    }
}


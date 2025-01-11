<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketInteraction extends Model
{
    protected $table = 'ticket_interactions';
    protected $fillable = [
        'ticket_id',
        'interaction_id'
    ];
    public $timestamps = false;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function interaction()
    {
        return $this->belongsTo(Interaction::class);
    }

}

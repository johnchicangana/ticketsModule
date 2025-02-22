<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['type', 'status', 'priority', 'interaction_id'];	

    public function ticketInteractions()
    {
        return $this->hasMany(TicketInteraction::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = ['message','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketInteractions()
    {
        return $this->hasMany(TicketInteraction::class);
    }
}

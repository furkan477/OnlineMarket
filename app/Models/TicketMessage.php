<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Ticket;

class TicketMessage extends Model
{
    protected $fillable = [
        'ticket_id',
        'sender_id',
        'messages',
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id','id');
    }
}

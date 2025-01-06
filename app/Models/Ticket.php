<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'status',
        'product_id',
        'recipient_id',
    ];

    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ticketmessage(){
        return $this->hasMany(TicketMessage::class,'ticket_id','id');
    }
}

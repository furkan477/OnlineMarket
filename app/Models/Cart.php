<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'qty',
        'user_id',
        'product_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}

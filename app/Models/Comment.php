<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'products_id',
        'rating',
        'comment'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function products(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];


    public function stores() {
        return $this->belongsTo(Stores::class,'store_id','id');
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class,'category_id','id');
    }

    public function carts(){
        return $this->hasMany(Cart::class,'product_id','id');
    }

    public function orderitems(){
        return $this->hasMany(Orderİtems::class,'product_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'products_id','id');
    }
}

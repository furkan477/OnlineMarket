<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'logo',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function products() {
        return $this->hasMany(Product::class,'store_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

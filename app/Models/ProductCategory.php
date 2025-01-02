<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'cat_ust',
    ];

    public function subcategory()
    {
        return $this->hasMany(ProductCategory::class,'cat_ust','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function getAllSubCategories($category){
        
        $categories = collect([$category->id]);

        foreach($category->subcategory as $subcat){
            $categories = $categories->merge($this->getAllSubCategories($subcat));
        }
        return $categories;
    }
}

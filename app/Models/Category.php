<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','cat_ust'];

    public function subcategories(){
        return $this->hasMany(Category::class,'cat_ust','id');
    }

    public function stores(){
        return $this->hasMany(Stores::class,'category_id','id');
    }


    public function getAllSubCategories($category){

        $categories = collect([$category->id]);
        
        foreach($category->subcategories as $sub_cat){
            $categories = $categories->merge($this->getAllSubCategories($sub_cat));
        }
        return $categories;
    }

    public function catStoreTotal(){
        $categoryIDS = $this->getAllSubCategories($this);
        return Stores::whereIn('category_id',$categoryIDS)->count();
    }
}

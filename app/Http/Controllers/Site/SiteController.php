<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $categories = Category::where('cat_ust','0')->get();
        return view('site.pages.home',compact('categories'));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function CommentCreate(Product $product, CommentRequest $request){

        Comment::create([
            'user_id' => Auth::id(),
            'products_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->withSuccess('Değerlendirmeniz Başarıyla Gerçekleştirildi.');
    }
}

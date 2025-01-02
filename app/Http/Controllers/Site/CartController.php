<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function Cart(User $user, Request $request)
    {
        $carts = Cart::where('user_id',  $user->id)->with('products')->get();
        $discount = 0;
        $coupon = Coupon::where('code',$request->code)->first();

        if($request->code){
            $discount += $coupon->discount;
        }

        return view('site.pages.cart.cart', compact('carts','discount', 'coupon'));

    }

    public function CartCreate(Product $product, CartRequest $request)
    {

        $data = $request->validated();
        $carts = Cart::get();

        $cartitem = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($cartitem) {
            $cartitem->qty += $data['qty'];
            if ($cartitem->qty > 5) {
                return back()->withErrors('bu üründen en fazla 5 adet alabilirsiniz.');
            }
            $cartitem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'qty' => $request->qty,
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('cart', Auth::id());
    }
}
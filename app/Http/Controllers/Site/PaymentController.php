<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderİtems;
use Auth;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function Payment(Request $request)
    {

        $cartItem = Cart::where('user_id', Auth::id())->get();

        if ($cartItem->isEmpty()) {
            return back()->withErrors('Sepetinizde Ürün Yok !');
        }


        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $request->discountprice,
            'address' => $request->address,
            'status' => 'pending',
        ]);

        foreach ($cartItem as $item) {
            Orderİtems::create([
                'order_id' => $order->id,
                'product_id' => $item->products->id,
                'qty' => $item->qty,
                'price' => $item->products->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        Stripe::setApiKey(env("STRIPE_SECRET"));


        $charge = Charge::create([
            "amount" => $request->discountprice * 100,
            "currency" => "try",
            "source" => $request->stripeToken,
            "description" => 'Sipariş ID ' . $order->id,
        ]);

        if ($charge->status == 'succeeded') {
            $order->status = 'shipped';
            $order->save();
            return redirect()->route('home', $order->id)->with('success', 'Siparişiniz başarılı bir şekilde oluşturuldu.');
        } else {
            $order->status = 'pending';
            $order->save();
            return redirect()->route('login')->with('error', 'Ödeme başarısız oldu.');
        }

    }
}

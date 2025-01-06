<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Order(User $user){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','desc')->get();
        return view('site.pages.order.order',compact('orders'));
    }
}

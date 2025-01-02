<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Order(User $user){
        $orders = Order::orderBy('id','desc')->get();
        return view('site.pages.order.order',compact('orders'));
    }
}

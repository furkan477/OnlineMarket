<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function Coupon(){
        $coupons = Coupon::get();
        return view('site.pages.coupon.coupon',compact('coupons'));
    }
}

@extends('site.layout.layout')
@section('content')

<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            @if(!empty($coupons) && $coupons->count() > 0)
                @foreach ($coupons as $coupon)
                    <div class="col-md-4">
                        <div class="card card-success">
                            <div class="card-header bg-danger">
                                <h3 class="card-title">{{$coupon->code}}</h3> 
                            </div>
                            <div class="card-body">
                                <p>{{$coupon->description}}</p>
                                <p><b>{{$coupon->discount}} ₺ indirim</b>
                                <p>son tarih <b>{{$coupon->expiration_date}}</b></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
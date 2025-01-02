@extends('site.layout.layout')

@section('content')

<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    @if(!empty($carts) && $carts->count() > 0)

                        <table>
                            <thead>
                                <tr>
                                    <th>Ürün</th>
                                    <th>Fiyatı</th>
                                    <th>Adeti</th>
                                    <th>Toplam Tutarı</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php    $total = 0 ?>
                                @if(!empty($carts) && $carts->count() > 0)
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="cart__product__item">
                                                <img src="{{asset('images/' . $cart->products->image)}}" alt="">
                                            </td>

                                            <td class="cart__price">{{$cart->products->price}} ₺</td>
                                            <td class="cart__quantity">{{$cart->qty}} Adet</td>
                                            <td class="cart__total">{{$cart->qty * $cart->products->price}} ₺</td>
                                            <td class="cart__close"><span class="icon_close"></span></td>
                                        </tr>
                                        <?php            $total += $cart->qty * $cart->products->price ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Kupon Kodunuz</h6>
                    <form action="{{route('cart.coupon', Auth::id())}}" , method="post">
                        @csrf
                        <input type="text" name="code" placeholder="Kupon kodunu giriniz">
                        <button type="submit" class="site-btn">Onayla</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Toplam Tutar</h6>
                    <ul>
                        @if($discount > 0)
                            <li>Sepetin Toplamı <span>{{$total}} ₺</span></li>
                            <li>Uygulanan İndirim <span>- {{$discount}} ₺</span></li>
                            <li>Yeni Ödenecek Tutar<span>{{$total -= $discount}} ₺</span></li>
                            <li>Kupon Kodu <span>{{$coupon->code}}</span></li>
                        @else
                            <li>Sepetin Toplam <span>{{$total ?? 0}} ₺</span></li>
                        @endif
                        <?php $totalprice = $total ?? 0?>
                    </ul>
                    <form action="{{route('payment')}}" method="post">
                        @csrf
                        <input type="hidden" name="discountprice" value="{{$total}}"></input>
                        <textarea name="address" class="formn-control" placeholder="Adres Giriniz"></textarea>
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ env('STRIPE_KEY') }}" data-amount="{{$totalprice * 100}}"
                            data-name="Online Market Platformu" data-description="Market ALışverişi"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="auto" data-currency="try">
                            </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
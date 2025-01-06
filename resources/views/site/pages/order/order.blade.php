@extends('site.layout.layout')
@section('content')

<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            @if(!empty($orders) && $orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="col-md-12 mt-5">
                        <div class="card card-success">
                            <div class="card-header" style="color: white; background-color: crimson;">
                                <h4 class="card-title">{{$order->user->name}} En Son Verilen Siparişin Hakkında Bilgiler.
                                    &nbsp;&nbsp;&nbsp; Sipariş Tarihi ; {{$order->created_at}}</h4>
                            </div>
                            <div class="card-body">

                                <h3 class="text-center mt-5 mb-5">
                                    <b>
                                        @if($order->status == 'pending')
                                            Siparişiniz Mağaza Tarafından Beklemeye Alındı.
                                        @elseif($order->status == 'shipped')
                                            Siparişiniz Mağaza Tarafından Kargoya Sevk Edildi :)
                                        @elseif($order->status == 'delivered')
                                            Siparişiniz Adrese Teslim Edildi, İyi Günlerde Kullanın :)
                                        @elseif($order->status == 'cancelled')
                                            Siparişiniz İptal Edildi.
                                        @endif
                                    </b>
                                </h3>

                                <div class="row mb-5">
                                    @if(!empty($order->orderitems) && $order->orderitems->count() > 0)
                                        @foreach ($order->orderitems as $orderitem)
                                            <div class="col-md-5 mt-5 ml-5">
                                                <div class="card card-success">
                                                    <div class="card-header" style="background-color: DarkTurquoise;">
                                                        <h3 class="card-title">{{$orderitem->products->name}}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-5">
                                                            <div class="col-md-12">
                                                                <div class="card card-gray">
                                                                    <img src="{{asset('images/' . $orderitem->products->image)}}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>Ürünün Kategorisi : <b>{{$orderitem->products->category->name}}</b></p>
                                                        <p>Ürünün Mağzası : <b>{{$orderitem->products->stores->name}}</b></p>
                                                        <p>Alınan Adet Fiyatı : <b>{{$orderitem->price}} ₺</b></p>
                                                        <p>Alınan Adet : <b>{{$orderitem->qty}} Adet</b></p>
                                                        <p>Sipariş Tarihiniz : <b>{{$order->created_at}}</b></p>
                                                        <form action="{{route('ticket.create',$orderitem->products->id)}}" method="post" class="checkout__form">
                                                            @csrf
                                                            @if ($errors)
                                                                @foreach ($errors->all() as $error)
                                                                    <div class="alert alert-danger">
                                                                        {{$error}}
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            @if (session()->get('success'))
                                                                <div class="alert alert-success">
                                                                    {{session()->get('success')}}
                                                                </div>
                                                            @endif

                                                            @if (session()->get('error'))
                                                                <div class="alert alert-danger">
                                                                    {{session()->get('error')}}
                                                                </div>
                                                            @endif
                                                            <input type="text" name="subject" class="form-control" placeholder="Destek Talebi Amacınızı Yazın">
                                                            <button type="submit" class="mt-2 btn btn-primary">Destek Talebi Başlat</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <p>Sipariş Tarihiniz : <b>{{$order->created_at}}</b></p>
                                <p>Siparişinizin Toplam Tutarı : <b>{{$order->total_price}} ₺</b>
                                <p>İsim Soyisim : <b>{{$order->user->name}}</b></p>
                                <p>Tel : <b>{{$order->user->phone}}</b></p>
                                <p>Adresiniz : <b>{{$order->address}}</b></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
@extends('site.layout.layout')
@section('content')

<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Destek Talebleriniz</th>
                                <th>Yetkili Mağaza</th>
                                <th>Yetkili Kişi</th>
                                <th>Ürün Adı</th>
                                <th>Durumu</th>
                                <th>Tarihi</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($tickets))
                                @foreach ($tickets as $ticket)
                                    <tr>

                                        <td class="">{{$ticket->subject}}</td>
                                        <td class="">{{$ticket->products->stores->name}}</td>
                                        <td class="">{{$ticket->products->stores->user->name}}</td>
                                        <td class="">{{$ticket->products->name}}</td>
                                        <td class="">{{$ticket->status}}</td>
                                        <td class="">{{$ticket->created_at}}</td>
                                        <td><a href="{{route('ticket.detail', $ticket->id)}}" class="btn btn-primary">
                                                Aç</a>&nbsp;<a href="" class="btn btn-danger">Sonlandır</a>
                                        <td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
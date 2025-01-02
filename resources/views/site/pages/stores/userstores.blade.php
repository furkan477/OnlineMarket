@extends('site.layout.layout')

@section('content')
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        @if(!empty($user->stores) && $user->stores->count() >= 1)
                            @foreach ($user->stores as $store)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{asset('logos/'.$store->logo)}}">
                                            <ul class="product__hover">
                                                <li><a href="{{asset('logos/'.$store->logo)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">{{$store->name}}</a></h6>
                                            <p>{{$store->description}}</p>
                                            <p>{{$store->category->name}} vb.</p>
                                            <a href="{{route('products.list',$store->id)}}" class="btn btn-warning">Görüntüle</a>
                                            <a href="{{route('stores.edit',$store->id)}}" class="btn btn-primary">Düzenle</a>
                                            <a href="{{route('products.list',$store->id)}}" class="btn btn-danger">Sil</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
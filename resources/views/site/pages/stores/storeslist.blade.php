@extends('site.layout.layout')

@section('content')
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-5 text-center">
                            <h2>{{$category->name}} Kategorisindeki Mağazalar</h2>
                        </div>
                        @if(!empty($stores) && $stores->count() >= 1)
                            @foreach ($stores as $store)
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
                                            <a href="{{route('products.list',$store->id)}}" class="btn btn-warning">Mağazayı Görüntüle</a>
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
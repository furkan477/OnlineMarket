@extends('site.layout.layout')

@section('content')

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product-1" class="product__big__img"
                                src="{{asset('logos/' . $store->logo)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3 class="mt-5">Mağaza Adı : <b>{{$store->name}}</b></h3>
                    <p class="mt-5">Mağaza Açıklaması : <b>{{$store->description}}</b></p>
                    <p class="mt-1">Mağaza Kategorisi : <b>{{$store->category->name}}</b></p>
                    <p class="mt-1">Mağaza Sahibi : <b>{{$store->user->name}}</b></p>
                    <p class="mt-1">Mağaza Ürün Sayısı : <b>Mağazanın {{count($products)}} Adet Ürünü
                            Bulunuyor</b></p>
                </div>
            </div>
            @if($store->user->id == Auth::id())
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <h5 class="text-center mb-3">Mağazanıza Satışa Sunacağınız Ürünleri Ekleyiniz</h5>
                        <form action="{{route('products.create', $store->id)}}" method="post" class="checkout__form"
                            enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="checkout__form__input">
                                        <p>Ürün Kategorisi<span>*</span></p>
                                        <select class="form-control" name="category_id">
                                            @foreach ($productcategories as $productcategory)
                                                @include('productsubcat', ['productcategory' => $productcategory, 'space' => ''])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="checkout__form__input">
                                        <p>Ürün Adı <span>*</span></p>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="checkout__form__input">
                                        <p>Ürün Resmi <span>*</span></p>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="checkout__form__input">
                                        <p>Ürün Fiyatı <span>*</span></p>
                                        <input type="text" name="price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                    <div class="checkout__form__input">
                                        <p>Ürün Stok Adeti <span>*</span></p>
                                        <input type="text" name="stock" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                    <div class="checkout__form__input">
                                        <p>Ürün Açıklaması <span>*</span></p>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-6">
                                    <button type="submit" class="site-btn">Ürünü Oluştur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mağazanın
                                Ürünleri</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3 mb-5">
                <div class="sidebar__categories">
                    <div class="section-title">
                        <h4>Kategoriler</h4>
                    </div>
                    <div class="categories__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading active">
                                    <form action="{{route('products.category.filter', $store->id)}}" method="post">
                                        @csrf
                                        @if (!empty($productcategories))
                                            <ul>
                                                @foreach ($productcategories as $productcategory)
                                                    @include('productsubcatview', ['productcategory' => $productcategory, 'space' => ' '])
                                                @endforeach
                                            </ul>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($products) && $products->count() >= 1)
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('images/' . $product->image)}}">
                                <ul class="product__hover">
                                    <li><a href="{{asset('images/' . $product->image)}}" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="{{route('products.detail', $product->id)}}"><span
                                                class="fa-solid fa-eye"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{$product->name}}</a></h6>
                                <!-- <div class="rating">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </div> -->
                                <div class="product__price">{{$product->price}} ₺</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
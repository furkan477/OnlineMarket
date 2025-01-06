@extends('site.layout.layout')

@section('content')

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__slider__content">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('images/' . $product->image)}}">
                            <ul class="product__hover">
                                <li><a href="{{asset('images/' . $product->image)}}" class="image-popup"><span
                                            class="arrow_expand"></span></a></li>
                                <li><a href="{{route('products.detail', $product->id)}}"><span
                                            class="fa-solid fa-eye"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
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
                    <h5 class="mb-3 text-right">{{$product->category->name}}</h5>
                    <h3>{{$product->stores->name}}</h3>
                    <h3>{{$product->name}}</h3>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div>
                    <div class="product__details__price">{{$product->price}} ₺</div>
                    <p>{{$product->description}}</p>
                    <form action="{{route('cart.create', $product->id)}}" method="post">
                        @csrf
                        <div class="product__details__button">
                            <select name="qty" class="form-control">
                                <option selected disabled>En Fazla 5 Adet Alabilirsiniz.</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <button class="cart-btn mt-5">Sepete Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Ürünün Hakkında
                                Yorumlar & Değerlendirmeler</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            @if(!empty($product->comments) && $product->comments->count() > 0)
                                @foreach ($product->comments as $comment)
                                    <div class="card card-success">
                                        <div class="card-header bg-danger">
                                            <h3 class="card-title">{{$comment->user->name}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$comment->comment}}</p>
                                            <p><b>Ürün Değerlendirme Puanı ; {{$comment->rating}}</b>
                                            <p>Yorumun Tarihi ; <b>{{$comment->created_at}}</b></p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif


                        </div>
                    </div>
                    <div class="mt-5">
                        @if ($control)
                            <form action="{{route('comment.create', $product->id)}}" method="post" class="checkout__form">
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                        <div class="checkout__form__input">
                                            <p>Ürün Değerlendirmesi <span>*</span></p>
                                            <select class="form-control" name="rating">
                                                <option value="1">1 puan</option>
                                                <option value="2">2 puan</option>
                                                <option value="3">3 puan</option>
                                                <option value="4">4 puan</option>
                                                <option value="5">5 puan</option>
                                            </select>
                                        </div>
                                        <div class="checkout__form__input mt-4">
                                            <p>Ürün Değerlendirme Yorum<span>*</span></p>
                                            <textarea class="form-control" name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <button type="submit" class="site-btn">Ürünü Değerlendir</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('site.layout.layout')

@section('content')

<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="coupon__link">Online market bir mağaza ekleyin ve satışlarınıza başlayın !</a></h6>
            </div>
        </div>
        <form action="{{route('stores.create')}}" method="post" class="checkout__form" enctype="multipart/form-data">
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
                <div class="col-lg-12">
                    <h5>Mağaza Bilgileriniz</h5>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <div class="checkout__form__input">
                                <p>Mağaza Kategorisi<span>*</span></p>
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        @include('subcategoriesoption', ['category' => $category, 'prefix' => ''])
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Mağaza Adı <span>*</span></p>
                                <input name="name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Mağaza Logonuz <span>*</span></p>
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="checkout__form__input">
                                <p>Mağaza Açıklaması <span>*</span></p>
                                <textarea class="form-control" name="description" id=""></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <button type="submit" class="site-btn">Mağazayı Oluştur</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
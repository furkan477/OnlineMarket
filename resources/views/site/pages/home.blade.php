@extends('site.layout.layout')

@section('content')

<section class="categories">
    <div class="container-fluid">
        <div class="row">
            @if(!empty($categories))
            @foreach ($categories as $category)
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                    <div class="categories__text">
                        <h4>{{$category->name}}</h4>
                        <p>Kategorideki Mağaza Sayısı {{$category->catStoreTotal()}} Adet</p>
                        <a href="{{route('stores',$category->id)}}">Mağazalara Git</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
           
        </div>
    </div>
</section>
<hr>



@endsection